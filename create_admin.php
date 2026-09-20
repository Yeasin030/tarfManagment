<?php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::firstOrCreate(
    ['email' => 'admin@example.com'],
    [
        'name' => 'Admin User',
        'password' => Hash::make('password'),
        'role' => 'admin',
        'email_verified_at' => now(),
    ]
);
echo "Admin user created: Email 'admin@example.com', Password 'password'\n";
