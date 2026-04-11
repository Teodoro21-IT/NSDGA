<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultAccountsSeeder extends Seeder
{
    /**
     * Seed default admin and registrar accounts.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'pengeskinnihayabusa@gmail.com'],
            [
                'full_name' => 'Admin User',
                'user' => 'admin',
                'phone_number' => '09170000001',
                'password' => Hash::make('adminpass'),
                'role' => 'admin',
                'is_locked' => false,
            ]
        );

        $registrar = User::updateOrCreate(
            ['email' => 'rafaelryantilacas@gmail.com'],
            [
                'full_name' => 'Registrar User',
                'user' => 'registrar',
                'phone_number' => '09170000002',
                'password' => Hash::make('registrarpass'),
                'role' => 'registrar',
                'is_locked' => false,
            ]
        );

        if ($admin->wasRecentlyCreated) {
            AuditLog::create([
                'user_id' => $admin->id,
                'action' => 'Created New Account',
                'target' => $admin->full_name . " ({$admin->user})",
                'ip_address' => '127.0.0.1',
            ]);
        }

        if ($registrar->wasRecentlyCreated) {
            AuditLog::create([
                'user_id' => $admin->id,
                'action' => 'Created New Account',
                'target' => $registrar->full_name . " ({$registrar->user})",
                'ip_address' => '127.0.0.1',
            ]);
        }

    }
}
