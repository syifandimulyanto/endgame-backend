<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Exception;
use Auth;
use Sentinel;

class LoginController extends Controller
{
    public function form(Request $request) {
        return view('admin.layouts.login');
    }

    public function login(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|min:7|max:30',
                'password' => 'required|min:4'
            ]);

            if ($validator->fails())
                return back()->withErrors($validator)->withInput();

            $user = User::where('email', $request->email)->first();
            if (!$user)
                throw new Exception('Email not found.');

            $auth = [];
            $auth['email'] = $request->email;
            $auth['password'] = $request->password;

            $login = Sentinel::authenticate($auth, true);
            if (!$login)
                throw new Exception('Password not correct with your email');

            return redirect()->route('admin.dashboard');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}