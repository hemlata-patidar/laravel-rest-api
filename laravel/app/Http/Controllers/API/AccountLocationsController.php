<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\AccountLocation;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AccountLocationsController extends BaseController
{
    public function index(Account $account)
    {
        $locations = $account->locations()->paginate(10);
        return $this->success($locations);
    }

    public function store(Request $request, Account $account)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'sometimes|in:active,inactive',
            'county' => 'sometimes|string',
            'access' => 'sometimes|string',
        ]);

        $location = DB::transaction(function() use ($request, $account) {
            return $account->locations()->create($request->all());
        });

        return $this->success($location, "Location created successfully");
    }

    public function show(Account $account, AccountLocation $location)
    {
        if ($location->account_id != $account->account_id) {
            return $this->error("Location does not belong to this account", 404);
        }

        return $this->success($location);
    }

    public function update(Request $request, Account $account, AccountLocation $location)
    {
        if ($location->account_id != $account->account_id) {
            return $this->error("Location does not belong to this account", 404);
        }

        $request->validate([
            'name' => 'sometimes|string',
            'status' => 'sometimes|in:active,inactive',
        ]);

        DB::transaction(function() use ($request, $location) {
            $location->update($request->all());
        });

        return $this->success($location, "Location updated successfully");
    }

    public function destroy(Account $account, AccountLocation $location)
    {
        if ($location->account_id != $account->account_id) {
            return $this->error("Location does not belong to this account", 404);
        }

        if ($location->cafes()->count() > 0) {
            return $this->error("Cannot delete location with existing cafes", 403);
        }

        DB::transaction(function() use ($location) {
            $location->delete(); // Soft delete recommended
        });

        return $this->success([], "Location deleted successfully");
    }
}
