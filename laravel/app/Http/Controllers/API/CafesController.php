<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Cafe;
use App\Models\AccountLocation;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CafesController extends BaseController
{
    public function index(Account $account, AccountLocation $location)
    {
        $cafes = $location->cafes()->where('account_id', $account->account_id)->paginate(10);
        return $this->success($cafes);
    }

    public function store(Request $request, Account $account, AccountLocation $location)
    {
        if ($location->account_id != $account->account_id) {
            return $this->error("Location does not belong to this account", 404);
        }

        $request->validate([
            'name' => 'required|string',
            'status' => 'sometimes|in:active,inactive',
            'menu_type' => 'sometimes|string',
            'position' => 'sometimes|integer',
            'is_default' => 'sometimes|boolean',
            'cost_center' => 'sometimes|string',
            // Add flags validations as needed
        ]);

        $cafe = DB::transaction(function() use ($request, $account, $location) {
            return Cafe::create(array_merge(
                $request->all(),
                ['account_id' => $account->account_id, 'location_id' => $location->location_id]
            ));
        });

        return $this->success($cafe, "Cafe created successfully");
    }

    public function show(Account $account, AccountLocation $location, Cafe $cafe)
    {
        if ($cafe->account_id != $account->account_id || $cafe->location_id != $location->location_id) {
            return $this->error("Cafe does not belong to this account/location", 404);
        }

        return $this->success($cafe);
    }

    public function update(Request $request, Account $account, AccountLocation $location, Cafe $cafe)
    {
        if ($cafe->account_id != $account->account_id || $cafe->location_id != $location->location_id) {
            return $this->error("Cafe does not belong to this account/location", 404);
        }

        $request->validate([
            'name' => 'sometimes|string',
            'status' => 'sometimes|in:active,inactive',
            'menu_type' => 'sometimes|string',
            'position' => 'sometimes|integer',
            'is_default' => 'sometimes|boolean',
        ]);

        DB::transaction(function() use ($request, $cafe) {
            $cafe->update($request->all());
        });

        return $this->success($cafe, "Cafe updated successfully");
    }

    public function destroy(Account $account, AccountLocation $location, Cafe $cafe)
    {
        if ($cafe->account_id != $account->account_id || $cafe->location_id != $location->location_id) {
            return $this->error("Cafe does not belong to this account/location", 404);
        }

        DB::transaction(function() use ($cafe) {
            $cafe->delete(); // Soft delete recommended
        });

        return $this->success([], "Cafe deleted successfully");
    }
}
