<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateUser extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name : User name } {email : User email } {password : password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

    /**
     * Execute the console command.
     */
    public function handle(CreatesNewUsers $creator)
    {
        try {
            $data = array_merge($this->arguments(), ['password_confirmation' => $this->argument('password')]);
            $user = $creator->create($data);

            $this->info("User with email {$user->email} successfully created");
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
