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
            'npm' => [
                'required',
                'string',
                'max:15',
                // Aturan validasi custom
                function ($attribute, $value, $fail) {
                    $biodata = Biodata::where('npm', $value)->first();

                    // Gagal HANYA JIKA biodata ada DAN sudah punya user_id
                    if ($biodata && $biodata->user_id !== null) {
                        // Ini adalah pesan error yang akan ditampilkan
                        $fail('NPM ini sudah terdaftar dan telah diklaim oleh user lain.');
                    }
                },
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        // Logika untuk menghubungkan atau membuat biodata
        Biodata::updateOrCreate(
            ['npm' => $request->npm],
            ['user_id' => $user->id]
        );

        event(new Registered($user));
        Auth::login($user);
        return redirect(route('dashboard', absolute: false));
    }
}
