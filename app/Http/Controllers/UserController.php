<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users|max:50',
            'email' => 'required|unique:users|max:100',
            'password' => 'required|min:6',
        ]);

        return User::create($request->all());
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'sometimes|required|max:50|unique:users,username,' . $user->id,
            'email' => 'sometimes|required|max:100|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|min:6',
        ]);

        $user->update($request->all());

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->noContent();
    }
}

