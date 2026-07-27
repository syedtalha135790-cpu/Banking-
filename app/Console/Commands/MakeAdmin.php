<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {name : The name of the admin} {email : The email of the admin} {password : The password of the admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new administrator user account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Check if user already exists
        $user = User::where('email', $email)->first();
        if ($user) {
            $validator = Validator::make([
                'name' => $name,
                'password' => $password,
            ], [
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            if ($validator->fails()) {
                $this->error('Failed to update existing user to admin. Validation errors:');
                foreach ($validator->errors()->all() as $error) {
                    $this->line("- $error");
                }
                return Command::FAILURE;
            }

            $user->name = $name;
            $user->role = 'admin';
            $user->password = Hash::make($password);
            $user->email_verified_at = $user->email_verified_at ?? now();
            $user->save();

            $this->info("User account with email '$email' already existed. Updated their name to '$name', role to 'admin', and updated password successfully!");
            return Command::SUCCESS;
        }

        // Validation for new user
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            $this->error('Failed to create admin user. Validation errors:');
            foreach ($validator->errors()->all() as $error) {
                $this->line("- $error");
            }
            return Command::FAILURE;
        }

        // Create the admin user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
            'email_verified_at' => now(), // Activated automatically
        ]);

        $this->info("Administrator user '$name' ($email) created successfully!");
        return Command::SUCCESS;
    }
}
