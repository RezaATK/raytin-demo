<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RecoveryPasswordRequest;
use App\Models\User\PasswordResetToken;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateWithMobileController extends Controller
{
    public function create(Request $request)
    {
        if(!session()->has('uuid')){
            return to_route('login');
        }

        $tokenRow = PasswordResetToken::query()->where('uuid', session('uuid'))->firstOrFail();
        if(Carbon::now()->greaterThan($tokenRow->created_at->addMinutes(30))){
            return to_route('login');
        }

        return view('auth.login_verify', compact('tokenRow'));
    }



    public function store(RecoveryPasswordRequest $request)
    {
        if(!session()->has('uuid')){
            return to_route('login');
        }

        $tokenRow = PasswordResetToken::query()->where('uuid', session('uuid'))->firstOrFail();

        if(Carbon::now()->greaterThan($tokenRow->created_at->addMinutes(30))){
            return to_route('login');
        }


        $user = User::query()->where('mobileNumber', '=', session('mobileNumber') ?? $tokenRow->mobileNumber)->firstOrFail();

        Auth::login($user);

        session()->remove('uuid');
        session()->remove('mobileNumber');

        return to_route('dashboard');
    }
}
