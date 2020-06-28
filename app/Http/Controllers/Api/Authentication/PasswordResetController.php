<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    /**
     * Create token password Reset
     *
     * @param Request $request
     */
    public function create(Request $request){
        $request->validate([
            'email' => 'email|string|required',
        ]);

        $input = $request->all();

        $user = User::where('email', $input['email'])->first();

        if (!$user)
            return response()->json(['message' => 'No User Found', 404]);

        $passwordReset = PasswordReset::updateorCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => $user->createToken('authToken')->accessToken,
            ]
        );

        if ($user && $passwordReset){
            $user->notify(new PasswordResetRequest($passwordReset->token));

            return response()->json(['message' => 'We have e-mailed your password reset link!']);
        }
    }

    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return JsonResponse [string] message
     */
    public function find($token){
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset)
            return response()->json(['message' => 'This password reset token is invalid.'], 404);

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json(['message' => 'This password reset token is invalid.'], 404);
        }

        return response()->json($passwordReset);
    }

    /**
     * Reset password
     *
     * @param Request $request
     * @return JsonResponse [string] message
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);

        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();

        if (!$passwordReset)
            return response()->json(['message' => 'This password reset token is invalid.'], 404);

        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json(['message' => "We can't find a user with that e-mail address."], 404);

        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));

        return response()->json(['message'=>'Password Reset Successful','user' => $user]);
    }
}
