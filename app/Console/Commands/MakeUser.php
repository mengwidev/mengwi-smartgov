<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\text;

class MakeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mgwsmartgov:make-user {name?} {email?} {username?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user for Mengwi SmartGov App';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name') ?: text('Masukkan nama:');
        $email = $this->argument('email') ?: text('Masukkan email:');
        $username = $this->argument('username') ?: text('Buat username:');
        $password = $this->getPassword();

        // Validate inputs
        $validator = Validator::make(
            compact('name', 'email', 'username', 'password'),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'username' => 'required|string|max:255|unique:users,username',
                'password' => 'required|string|min:8',
            ]
        );

        if ($validator->fails()) {
            $this->error('Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return Command::FAILURE;
        }

        try {
            // Create user
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => Hash::make($password),
            ]);

            $this->info("User {$user->name} created successfully!");
        } catch (\Exception $e) {
            $this->error("Failed to create user: {$e->getMessage()}");
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    /**
     * Prompt for a password with confirmation.
     *
     * @return string
     */
    protected function getPassword(): string
    {
        do {
            $password = $this->secret('Buat password:');
            $confirmation = $this->secret('Konfirmasi password:');

            if ($password !== $confirmation) {
                $this->error('Password tidak cocok, coba lagi.');
            }
        } while ($password !== $confirmation);

        return $password;
    }
}
