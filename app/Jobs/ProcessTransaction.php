<?php

namespace App\Jobs;

use App\Models\Account;
use App\Services\TransactionService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Account $account,
        protected float $amount,
        protected string $note,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(TransactionService $service): void
    {
        $service->create($this->account, $this->amount, $this->note);
    }
}
