<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RecoveryPasswordRequest;
use App\Models\User\PasswordResetToken;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
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
        return view('auth.reset-password');
    }


    public function store(RecoveryPasswordRequest $request): RedirectResponse
    {
        if(!session()->has('uuid')){
            return to_route('password.mobile');
        }

        $tokenRow = PasswordResetToken::query()->where('uuid', session('uuid'))->firstOrFail();
        if(Carbon::now()->greaterThan($tokenRow->created_at->addMinutes(30))){
            return to_route('password.mobile');
        }


        $password = Hash::make($request->password);

        User::query()->where('mobileNumber', '=', $tokenRow->mobileNumber)->update(['password' => $password]);

        session()->remove('uuid');
        session()->remove('mobileNumber');

        return redirect('/')->with('success', 'کلمه عبور شما با موفقیت بروزرسانی شد.');
    }
}
