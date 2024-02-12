<?php

namespace App\Services;

use App\Models\Account;
use App\Models\AccountTransaction;
use Exception;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function create(Account $account, float $amount, string $note): AccountTransaction
    {
        try {
            DB::beginTransaction();

            $account->provideTransaction($amount);
            $account->save();

            $transaction = AccountTransaction::create([
                'account_id' => $account->id,
                'amount' => $amount,
                'note' => $note,
            ]);

            DB::commit();

            return $transaction;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function list(Account $account, ?string $search)
    {
        $query = DB::table('account_transactions');
        $query->where('account_id', '=', $account->id);

        if (!empty($query)) {
            $query->whereRaw('LOWER(`note`) LIKE ? ', ['%' . trim(strtolower($search)) . '%']);
        }

        return $query->latest()->get();
    }
}
