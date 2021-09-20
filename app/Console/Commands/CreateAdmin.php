<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an admin user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = $this->ask('Username');
        $password = $this->ask('Password');
        $full_name = $this->ask('Full Name');

        $model = User::create([
            'is_administrator' => 1,
            'client_id' => null,
            'type_id' => null,
            'full_name' => $full_name,
            'email' => $username,
            'password' => password_hash($password, PASSWORD_ARGON2I),
            'expires_at' => null,
            'config' => [
                'requireEmailConfirmation' => false,
                'autoGeneratePassword' => false,
                'requirePasswordChangeOnFirstLogin' => false,
                'passwordChangedOnFirstLogin' => false,
            ]
        ]);

        $this->info('Administrative account created. ID: '. $model->id. '. You can log in to the system using the account');

        return 0;
    }
}
