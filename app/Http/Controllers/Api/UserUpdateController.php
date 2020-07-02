<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserUpdateController extends Controller
{
    /**
     * User info update
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function updateAuthUser(Request $request, $id){
        //find user by id
        $user = User::find($id);

        //Update user Fields
        $user->update($request->all());

        //Save user info
        $user->save();

        return response()->json(['message'=>'User Information Update Successful', 'user' => $user,],200);
    }
}

