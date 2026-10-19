<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Action\Auth\Login;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class SessionsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('auth/Login');
    }

    public function store(LoginRequest $request, Login $action): RedirectResponse
    {
        return $action->login($request->validated());
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('home');
    }
}
