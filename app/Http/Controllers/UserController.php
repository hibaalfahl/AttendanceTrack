<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private array $users = [
        1 => [
            'id' => 1,
            'full_name' => 'Ahmad Ali',
            'username' => 'ahmad',
            'email' => 'ahmad@example.com',
            'phone' => '0911111111',
            'birth_date' => '1990-05-15',
            'department_id' => null,
            'role' => 'manager',
            'status' => 'active',
        ],
        2 => [
            'id' => 2,
            'full_name' => 'Sara Khaled',
            'username' => 'sara',
            'email' => 'sara@example.com',
            'phone' => '0922222222',
            'birth_date' => '1995-08-20',
            'department_id' => null,
            'role' => 'employee',
            'status' => 'active',
        ],
        3 => [
            'id' => 3,
            'full_name' => 'Omar Hassan',
            'username' => 'omar',
            'email' => 'omar@example.com',
            'phone' => '0933333333',
            'birth_date' => '1988-03-10',
            'department_id' => null,
            'role' => 'teacher',
            'status' => 'active',
        ],
        4 => [
            'id' => 4,
            'full_name' => 'Lina Mahmoud',
            'username' => 'lina',
            'email' => 'lina@example.com',
            'phone' => '0944444444',
            'birth_date' => '2002-07-12',
            'department_id' => null,
            'role' => 'student',
            'status' => 'active',
        ],
        5 => [
            'id' => 5,
            'full_name' => 'Khaled Ibrahim',
            'username' => 'khaled',
            'email' => 'khaled@example.com',
            'phone' => '0955555555',
            'birth_date' => '1993-11-05',
            'department_id' => null,
            'role' => 'exam_officer',
            'status' => 'inactive',
        ],
    ];

    public function index()
    {
        $users = session('demo_users', $this->users);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $users = session('demo_users', $this->users);
        $validated = $request->validated();

        $id = empty($users) ? 1 : max(array_keys($users)) + 1;

        unset($validated['password'], $validated['password_confirmation'], $validated['photo']);

        $validated['role'] = $request->user()->can('roles.manage')
            ? ($validated['role'] ?? 'employee')
            : 'employee';

        $users[$id] = array_merge($validated, [
            'id' => $id,
            'status' => 'active',
        ]);

        session(['demo_users' => $users]);

        return redirect()->route('users.index');
    }

    public function show(int $user)
    {
        $users = session('demo_users', $this->users);

        abort_unless(isset($users[$user]), 404);

        $user = $users[$user];

        return view('users.show', compact('user'));
    }

    public function edit(int $user)
    {
        $users = session('demo_users', $this->users);

        abort_unless(isset($users[$user]), 404);

        $user = $users[$user];

        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, int $user)
    {
        $users = session('demo_users', $this->users);

        abort_unless(isset($users[$user]), 404);

        $validated = $request->validated();

        unset($validated['password'], $validated['password_confirmation'], $validated['photo']);

        if (!$request->user()->can('roles.manage')) {
            unset($validated['role']);
        }

        $users[$user] = array_merge($users[$user], $validated);

        session(['demo_users' => $users]);

        return redirect()->route('users.index');
    }

    public function destroy(int $user)
    {
        $users = session('demo_users', $this->users);

        abort_unless(isset($users[$user]), 404);

        unset($users[$user]);

        session(['demo_users' => $users]);

        return redirect()->route('users.index');
    }

    public function changeStatus(int $user)
    {
        $users = session('demo_users', $this->users);

        abort_unless(isset($users[$user]), 404);

        $users[$user]['status'] = $users[$user]['status'] === 'active'
            ? 'inactive'
            : 'active';

        session(['demo_users' => $users]);

        return redirect()->route('users.show', $user);
    }
}
