<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login()
    {
        return view('user.login.login');
    }

    public function post_login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required|min:6|max:32',
        // ]);
        $email = $request->email;
        $password = $request->password;
        // dd($request->all());

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            if(Auth::user()->role == 0){
                return redirect()->route('users.list');
            }else{
                return redirect()->route('users.index');
            }
        }
    }

    public function Register()
    {
        return view('user.login.register');
    }
    public function post_register(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|min:6|max:32',
        //     'email' => 'required',
        //     'password' => 'required|min:6',
        //     'detail' => 'required|max:255'
        // ]);
        $users = new User();
        $users->fill($request->all());
        $users->password = bcrypt($request->password);
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatarName = $avatar->hashName();
            $avatarName = $request->username . '_' . $avatarName;

            $users->avatar = $avatar->storeAs('images/users', $avatarName);
            //storage
        } else {
            $users->avatar = '';
        }
        $users->save();
        return redirect()->route('auth.login');
    }

    public function logout(Request $request)
    {
        Cart::destroy(Cart::all()->where('users_id', Auth::user()->id));
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
