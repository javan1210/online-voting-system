<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void {
        Admin::create([
            'username' => 'superadmin',
            'email'    => 'admin@voting.com',
            'password' => Hash::make('Admin@1234'),
            'role'     => 'superadmin',
        ]);
    }
}