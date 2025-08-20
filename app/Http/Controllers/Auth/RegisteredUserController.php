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
                // --- INI BAGIAN PENTINGNYA ---
                // Validasi custom: NPM dianggap sudah ada HANYA JIKA
                // biodata dengan NPM tersebut sudah punya user_id (sudah diklaim).
                function ($attribute, $value, $fail) {
                    $biodata = Biodata::where('npm', $value)->first();

                    if ($biodata && $biodata->user_id !== null) {
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

        // --- LOGIKA PENGHUBUNGAN BIODATA YANG DISEMPURNAKAN ---
        // Cari biodata berdasarkan NPM. Jika tidak ada, buat baru.
        // Jika ada, perbarui user_id-nya dengan id user yang baru dibuat.
        Biodata::updateOrCreate(
            ['npm' => $request->npm],
            ['user_id' => $user->id]
        );
        // --------------------------------------------------------

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
