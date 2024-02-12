<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\TransactionService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\Validator;

class ProvideTransaction extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:provide
                            {email : User\'s email}
                            {amount : Amount of transaction. To pass negative value double dash must be typed before value}
                            {note : Description of transaction}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Provide new user\'s transaction';

    /**
     * Execute the console command.
     */
    public function handle(TransactionService $service)
    {
        try {
            Validator::make($this->arguments(), [
                'amount' => 'required|numeric|decimal:0,2',
                'note' => 'required|string',
            ])->validate();

            $email = $this->argument('email');
            $user = User::where('email', $email)->first();

            if (!$user) {
                $this->error("No user found with email $email");
                return;
            };


            $transaction = $service->create($user->account, $this->argument('amount'), $this->argument('note'));
            $this->info("Trnsaction for {$transaction->amount} was successfully created");
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
