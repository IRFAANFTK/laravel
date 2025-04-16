<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->with('department')->paginate(5);
        return view('users.index', [
            'users' => $users
        ]);

    }

    public function create()
    {

        $users = User::all();
        return view('users.create', [
            'users' => $users
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
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
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
