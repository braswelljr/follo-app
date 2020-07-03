<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    protected $providers = [
        'google','facebook',
    ];

    public function register(Request $request){
        //validate user input
        $validator = Validator::make($request->all(),[
           'title' => 'required',
           'first_name' => 'required',
           'middle_name' => 'nullable',
            'last_name' => 'nullable',
            'date_of_birth_or_age' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'telephone' => 'required',
            'residence' => 'nullable',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()){
            return response()->json(['error' => $validator->errors()],401);
        }

        //hash password
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        //create user
        $user = User::create($input);

        //create access token
        $accessToken = $user->createToken('remember_token')->accessToken;

        return response()->json(['message'=>'User Registration Successful','user' => $user, 'remember_token' => $accessToken]);
    }

    /**
     * Sign up with Google account
     * @param Request $request
     */
    public function registerWithGoogle(Request $request){

    }

    /**
     * @register user with facebook account
     * @param Request $request
    */
    public function registerWithFacebook(Request $request){

    }
}
