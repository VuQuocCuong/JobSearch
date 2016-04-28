<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use OAuth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    protected $redirectPath = '/index';
    protected $loginPath = '/auth/login';

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function getLogin()
    {
        return view('login');
    }
    use AuthenticatesAndRegistersUsers;

    public function postLogin(LoginRequest $request)
    {

        $tvar = $request->input('username');
        $pw = $request->input('password');

        if ($this->auth->attempt(['username' => $tvar, 'password' => $pw]))
        {
            return redirect('/index');
        }
        echo ' not logged in';

    }
    protected function getRegister()
    {
        return view('auth/register');
    }
    protected function postRegister(Request $request)
    {
        $username   = $request->input('username', '');
        $password   = $request->input('password', '');
        $email      = $request->input('email', '');

        return User::insert([
            'username' => $username, 'password' => $password, 'email' => $email
        ]);
    }
    /**
    * Login user with facebook
    *
    * @return void
    */

    public function loginWithFacebook(Request $request)
    {
        // get data from request
        $code = $request->get('code');

        // get fb service
        $fb = \OAuth::consumer('Facebook');

        // check if code is valid

        // if code is provided get user data and sign in
        if ( ! is_null($code))
        {
            // This was a callback request from facebook, get the token
            $token = $fb->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($fb->request('/me'), true);

            // $message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            // echo $message. "<br/>";

            //Var_dump
            //display whole array.
            // dd($result);
            $request->session()->set('user', $result);
            return redirect('/index');
        }
        // if not ask for permission first
        else
        {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
            return redirect((string)$url);
        }
    }

    public function logOut(Request $request) {
        $request->session()->forget('user');
        return redirect('/index');
    }
}