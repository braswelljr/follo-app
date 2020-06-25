<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
           'title' => 'required',
           'first_name' => 'required',
           'middle_name' => 'nullable',
            'last_name' => 'nullable',
            'date_of_birth/age' => 'required',
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

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json(['user' => auth()->user(), 'accessToken' => $accessToken]);
    }
}
