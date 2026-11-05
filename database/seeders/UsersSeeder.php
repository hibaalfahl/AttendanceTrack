<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'full_name' => 'Ahmad Ali',
                'username' => 'manager1',
                'email' => 'manager@gmail.com',
                'phone' => '0911111111',
                'birth_date' => '1990-05-15',
                'role' => 'manager',
            ],
            [
                'full_name' => 'Sara Khaled',
                'username' => 'employee1',
                'email' => 'employee@gmail.com',
                'phone' => '0922222222',
                'birth_date' => '1995-08-20',
                'role' => 'employee',
            ],
            [
                'full_name' => 'Omar Hassan',
                'username' => 'teacher1',
                'email' => 'teacher@gmail.com',
                'phone' => '0933333333',
                'birth_date' => '1988-03-10',
                'role' => 'teacher',
            ],
            [
                'full_name' => 'Lina Mahmoud',
                'username' => 'student1',
                'email' => 'student@gmail.com',
                'phone' => '0944444444',
                'birth_date' => '2002-07-12',
                'role' => 'student',
            ],
            [
                'full_name' => 'Khaled Ibrahim',
                'username' => 'exam1',
                'email' => 'exam@gmail.com',
                'phone' => '0955555555',
                'birth_date' => '1993-11-05',
                'role' => 'exam_officer',
            ],
        ];

        foreach ($users as $data) {

            $role = $data['role'];
            unset($data['role']);

            $user = User::updateOrCreate(
                ['username' => $data['username']],
                array_merge($data, [
                    'password' => '123456789',
                    'department_id' => null,
                    'status' => 'active',
                ])
            );

            $user->syncRoles([$role]);
        }
    }
}
