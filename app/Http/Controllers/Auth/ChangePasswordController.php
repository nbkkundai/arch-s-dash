<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

use app\Models\User;

class ChangePasswordController extends Controller
{
    public function changePassword()
    {
        return view('auth.passwords.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'password_confirmation' => ['same:password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);

        return redirect('/');
    }
}
