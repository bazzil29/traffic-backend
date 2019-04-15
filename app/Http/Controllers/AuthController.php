<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('adminRIA', ['except' => 'adminLogout']);
    }

    public function showAdminLoginForm()
    {
        return view('admin.pages.admin-login');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function adminLogin(Request $request)
    {
        $user = new User();
        $validator = Validator::make($request->all(), $user->ruleLogin());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $input = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            if (Auth::attempt($input, $request->has('remember'))) {
                return redirect()->route('current');
            } else {
                return redirect()->route('login')->with(['login_fail' => 'username or password incorect'])->withInput();
            }
        }
    }

    public function adminLogout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('login');
    }

}
