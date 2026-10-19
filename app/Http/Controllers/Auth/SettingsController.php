<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Action\Settings\UpdateProfile;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SettingsController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();

        abort_unless($user instanceof User, 404);

        return Inertia::render('auth/settings/UpdateProfile', [
            'email' => $user->email,
        ]);
    }

    public function update(UpdateSettingsRequest $request, #[CurrentUser()] User $user, UpdateProfile $action): RedirectResponse
    {
        $action->update(
            ['email' => $request->validated('email')],
            $request->validated('password'),
            $user,
        );

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Account settings updated successfully.',
        ]);

        return to_route('auth.settings.index');
    }
}
