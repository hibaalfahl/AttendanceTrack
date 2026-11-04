<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create manager account
        $manager = User::updateOrCreate(
            ['username' => 'manager1'],
            [
                'full_name' => 'Ahmad Ali',
                'email' => 'manager@gmail.com',
                'password' => '123456789',
                'phone' => '0912345678',
                'department_id' => null,
                'birth_date' => '1990-05-15',
                'status' => 'active',
            ]
        );

        $manager->syncRoles(['manager']);

        // Create employee account
        $employee = User::updateOrCreate(
            ['username' => 'employee1'],
            [
                'full_name' => 'Sara Khaled',
                'email' => 'employee@gmail.com',
                'password' => '123456789',
                'phone' => '0987654321',
                'department_id' => null,
                'birth_date' => '1998-08-20',
                'status' => 'active',
            ]
        );

        $employee->syncRoles(['employee']);
    }
}
