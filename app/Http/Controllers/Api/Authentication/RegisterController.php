<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\User;
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
           'title' => 'nullable',
           'first_name' => 'nullable',
           'middle_name' => 'nullable',
            'last_name' => 'nullable',
            'username' => 'required|unique:users',
            'date_of_birth_or_age' => 'nullable',
            'gender' => 'nullable',
            'marital_status' => 'nullable',
            'telephone' => 'required',
            'residence' => 'nullable',
            'email' => 'nullable',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()){
            return response()->json(['error' => $validator->errors()],401);
        }

        //hash password
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['customer_id'] = uniqid();

        //create user
        $user = User::create($input);

        //create access token //->insert access token into user input
        $accessToken = $user->createToken('remember_token')->accessToken;
        $user['remember_token'] = $accessToken;


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
