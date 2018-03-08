<?php namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller {

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
    


 	/**
     * Show the profile for the given user.
     *
     * @return Response
     */
	public function login()
	{

    	return view('auth.login');
	}

    public function logout(){
        Auth::logout();
        return redirect()->intended('auth/login');
    }

	/**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
    	$usuario = $request->input('usuario');
    	$senha = $request->input('senha');

        if (Auth::attempt(['usuario' => $usuario, 'password' => $senha]))
        {
            Session::put(['user.plain_pass' => $senha]);
            return redirect()->intended('consulta');
        }else{
             return redirect()->back();
        }
    }

}
