<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/';
    // protected $username;
    

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->username = $this->findUsername();
    }

    // public function findUsername()
    // {
    //     $login = request()->input('login');
 
    //     $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
 
    //     request()->merge([$fieldType => $login]);
 
    //     return $fieldType;
    // }

    public function username()
    {
        return 'name';
    }
    // public function login(Request $request)
    // {   
    //     $input = $request->all();
   
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'password' => 'required',
    //     ]);
   
    //     if(auth()->attempt(array('name' => $input['name'], 'password' => $input['password'])))
    //     {
    //         if (auth()->user()->is_admin == 1) {
    //             return redirect()->route('patients.index');
    //         }else{
    //             return redirect()->route('home');// user home
    //         }
    //     }else{
    //         return redirect()->route('login')
    //             ->with('error','اسم المستخدم او كلمه المرور غير صحيحه');
    //     }
          
    // }
    protected function attemptLogin(Request $request)
    {
        $user = User::where('name', $request->name)
            ->where('password', $request->password)
            ->first();

        if(!isset($user)){
            return false;
        }

        Auth()->login($user);

        return true;
    }
}
