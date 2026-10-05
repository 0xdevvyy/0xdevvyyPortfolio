<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Action\Auth\Login;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
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
}
