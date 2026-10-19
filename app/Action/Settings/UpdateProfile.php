<?php

declare(strict_types=1);

namespace App\Action\Settings;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SensitiveParameter;

final readonly class UpdateProfile
{
    /**
     * @param  array{email: string}  $data
     */
    public function update(array $data, #[SensitiveParameter] ?string $password, User $user): void
    {
        DB::transaction(function () use ($data, $password, $user): void {
            $user->email = $data['email'];

            if (
                $password !== null
                && $password !== ''
                && ! Hash::check($password, $user->password)
            ) {
                $user->password = $password;
            }

            $user->save();
        });
    }
}
