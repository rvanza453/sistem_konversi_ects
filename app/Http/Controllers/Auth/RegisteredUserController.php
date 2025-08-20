<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Biodata;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'npm' => ['required', 'string', 'max:15', 'unique:biodatas,npm,NULL,id,user_id,NULL'], // Validasi canggih
        ]);
    
        // Pesan validasi kustom jika NPM sudah diklaim
        $request->validate([
             'npm' => ['unique:biodatas,npm,NULL,id,user_id,!' . NULL],
        ], ['npm.unique' => 'NPM ini sudah terdaftar oleh user lain.']);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // role 'mahasiswa' adalah default, jadi tidak perlu di set
        ]);
    
        // --- LOGIKA PENGHUBUNGAN BIODATA ---
        $biodata = Biodata::firstOrCreate(['npm' => $request->npm]);
        $biodata->user_id = $user->id;
        $biodata->save();
        // ------------------------------------
    
        event(new Registered($user));
        Auth::login($user);
        return redirect(route('dashboard', absolute: false));
    }
}
