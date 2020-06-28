<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
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
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)){
            return response(['message' => 'Wrong Credentials']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response()->json(['message'=>'Login Successful','user' => Auth::user(), 'accessToken' => $accessToken]);
    }

    /**
     *Login with Google
     * @param Request $request
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
