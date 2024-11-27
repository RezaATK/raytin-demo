<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RecoveryPasswordRequest;
use App\Models\User\PasswordResetToken;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifyResetCodeController extends Controller
{
    public function create(Request $request)
    {
        if(!session()->has('uuid')){
            return to_route('password.mobile');
        }

        $tokenRow = PasswordResetToken::query()->where('uuid', session('uuid'))->firstOrFail();
        if(Carbon::now()->greaterThan($tokenRow->created_at->addMinutes(30))){
            return to_route('password.mobile');
        }

        return view('auth.verify-reset-code');
    }


    public function store(RecoveryPasswordRequest $request)
    {
//        $allTokens = PasswordResetToken::all();
//        $request->validate([
//            'code' => ['required', Rule::in($allTokens->pluck('token')->toArray())],
//        ]);

        if(!session()->has('uuid')){
            return to_route('password.mobile');
        }

        $tokenRow = PasswordResetToken::query()->where('uuid', session('uuid'))->firstOrFail();

        if(Carbon::now()->greaterThan($tokenRow->created_at->addMinutes(30))){
            return to_route('password.mobile');
        }


        return to_route('password.reset');
    }
}
