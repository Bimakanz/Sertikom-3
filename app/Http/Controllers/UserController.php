<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $users = User::latest()->paginate(5);
        return view('users.index', compact('users'));
    }

     public function create()
    {
        return view('users.create');
    }

    /**
     * Show the form for creating a new resource.
     */
   public function store(Request $request)
{   
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'role' => 'required|in:siswa,guru',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
    ]);

    \App\Models\ActivityLog::create([
        'description' => "User Ditambahkan: {$user->name}"
    ]);

    return redirect()->route('users.index')->with('success', 'User berhasil dibuat');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {   
        \App\Models\ActivityLog::create([
        'description' => "User Di Edit: {$user->name}"
    ]);

        // Check role access (only admin can access user management)
        $userAuth = auth()->user();
        if ($userAuth->role !== 'admin') {
            abort(403, 'Access denied');
        }

        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:siswa,guru',
        ];

        // Add password validation only if a new password is provided
        if ($request->filled('password')) {
            $validationRules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($validationRules);

        // Prepare update data
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Add password to update data only if provided
        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        $user->update($updateData);

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {   \App\Models\ActivityLog::create([
        'description' => "User Di Hapus: {$user->name}"
    ]);
         $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
