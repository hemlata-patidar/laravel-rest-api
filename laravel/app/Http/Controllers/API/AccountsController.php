<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AccountsController extends BaseController
{
    public function index()
    {
        $accounts = Account::paginate(10);
        return $this->success($accounts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:accounts,name',
            'status' => 'sometimes|in:active,inactive',
            'eni_enabled' => 'sometimes|boolean',
            'account_type' => 'sometimes|string',
            // add other flags validation as needed
        ]);

        $account = DB::transaction(function() use ($request) {
            return Account::create($request->all());
        });

        return $this->success($account, "Account created successfully");
    }

    public function show(Account $account)
    {
        return $this->success($account);
    }

    public function update(Request $request, Account $account)
    {
        $request->validate([
            'name' => ['sometimes','string', Rule::unique('accounts')->ignore($account->account_id,'account_id')],
            'status' => 'sometimes|in:active,inactive',
        ]);

        DB::transaction(function() use ($request, $account) {
            $account->update($request->all());
        });

        return $this->success($account, "Account updated successfully");
    }

    public function destroy(Account $account)
    {
        if ($account->locations()->count() > 0) {
            return $this->error("Cannot delete account with existing locations", 403);
        }

        DB::transaction(function() use ($account) {
            $account->delete();
        });

        return $this->success([], "Account deleted successfully");
    }
}
