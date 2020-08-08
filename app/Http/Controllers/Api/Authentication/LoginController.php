<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    protected $providers = [
        'google','facebook',
    ];

    /**
     *
     * @param Request $request
     *
     * @return JsonResponse|Response
     */
    public function login(Request $request){
        $credentials = $request->only(['email','username', 'password']);

        if (!Auth::attempt($credentials)){
            return response(['message' => 'Wrong Credentials or User Does not exists.']);
        }

        //create access token
        $accessToken = Auth::user()->createToken('accessToken')->accessToken;

        return response()->json(['message'=>'User Login Successful','user' => Auth::user(), 'accessToken' => $accessToken]);
    }

    /**
     *Login with Google
     * @param Request $request
     * @return void
     */
    public function loginWithGoogle(Request $request){

    }

    /**
     * Login User with Facebook Account
     * @param Request $request
    */
    public function loginWithFacebook(Request $request){

    }
}
