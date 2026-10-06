<?php

declare(strict_types=1);

namespace App\Action\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

final readonly class Login
{
    /**
     * @param  array<string>  $data
     */
    public function login(array $data): RedirectResponse
    {
        if (! Auth::attempt($data)) {
            Inertia::flash('toast', [
                'type' => 'error',
                'message' => 'Engkkk!... Something is wrong with your input!!!',
            ]);

            return back();
        }

        request()->session()->regenerate();
        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Login Successful',
        ]);

        return to_route('dashboard');

    }
}
