<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.admin.index')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function edit(User $admin)
    {
        if ($admin->role !== 'admin') {
            return redirect()->route('admin.admin.index')->with('error', 'User bukan admin!');
        }
        
        return view('admin.admin.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        if ($admin->role !== 'admin') {
            return redirect()->route('admin.admin.index')->with('error', 'User bukan admin!');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $admin->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $admin->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.admin.index')->with('success', 'Data admin berhasil diperbarui!');
    }

    public function destroy(User $admin)
    {
        if ($admin->role !== 'admin') {
            return redirect()->route('admin.admin.index')->with('error', 'User bukan admin!');
        }

        // Mencegah admin menghapus dirinya sendiri
        if ($admin->id === auth()->id()) {
            return redirect()->route('admin.admin.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $admin->delete();

        return redirect()->route('admin.admin.index')->with('success', 'Admin berhasil dihapus!');
    }
}
