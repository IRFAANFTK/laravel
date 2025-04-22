<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('department')->withCount('tasks')->paginate(5);


        return view('users.index', [
            'users' => $users
        ]);

    }

    public function create()
    {
        $departments = Department::all();
        $users = User::all();
        return view('users.create', [
            'users' => $users,
            'departments' => $departments

        ]);
    }

    public function store(Request $request)
    {
        User::create($request->all());
        return redirect()->route('users.index')
            ->withSuccess('New User is added successfully.');
    }

    public function show(User $user)
    {
        $user->load('tasks');
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        $departments = Department::all();
        return view('users.edit', compact('user', 'departments'));


    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->back()
            ->withSuccess('User is updated successfully.');

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->withSuccess('User is deleted successfully.');
    }
}
