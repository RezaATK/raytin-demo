<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RecoveryPasswordRequest;
use App\Models\User\PasswordResetToken;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class AuthenticateWithMobileSessionController extends Controller
{
    public function store(RecoveryPasswordRequest $request): RedirectResponse
    {
        $token = random_int(1112, 9989);

        $uuid = Str::uuid();

        while(PasswordResetToken::query()->where('uuid', $uuid)->exists()){
            $uuid = Str::uuid();
        }

        PasswordResetToken::query()->updateOrCreate(
            ['mobileNumber' => $request->mobileNumber, ],
            [
                'token' => $token,
                'uuid' => $uuid,
            ]);

        session()->put('uuid', $uuid);
        session()->put('mobileNumber', $request->mobileNumber);

        return to_route('login-with-mobile-create');
//        return to_route('login-with-mobile-create', ['uuid' => $uuid]);
//        return redirect()->intended(route('dashboard', absolute: false));
    }
}
