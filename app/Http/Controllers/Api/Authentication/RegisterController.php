<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Symfony\Component\Console\Input\Input;
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
      return response()
      ->json([
        'error' => $validator
          ->errors()
      ],401);
    }

    //hash password
    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $input['customer_id'] = uniqid();

      //create user
    $user = User::create($input);

      //create access token //->insert access token into user input
    $accessToken = $user->createToken('accessToken')->accessToken;


    return response()
      ->json([
        'message'=>'User Registration Successful',
        'user' => $user,
        'accessToken' => $accessToken
      ]);
  }

  /**
   * Redirect the user to the GitHub authentication page.
   *
   * @return Response
   */
  public function redirectToProvider(){
    return Socialite::driver('google')->redirect();
  }

  /**
   * Obtain the user information from GitHub.
   *
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function handleProviderCallback(Request $request){
    $data = json_encode(Socialite::driver('google')->user());

    $input['username'] = $data['nickname'];
    $input['firstname'] = $data['name'];
    $input['email'] = $data['email'];
    $input['customer_id'] = uniqid();

    $validator = Validator::make($request->all(), $input);

    if ($validator->fails()){
      return response()
        ->json([
          'error' => $validator
            ->errors()
        ],401);
    }

    $user = User::create($input);

    $accessToken = $user->createToken('accessToken')->accessToken;


    return response()
      ->json([
        'message'=>'User Registration Successful',
        'user' => $user,
        'accessToken' => $accessToken
      ]);
  }
  /**
   * @register user with facebook account
   * @param Request $request
   */
  public function registerWithGoogle(Request $request, $user){

  }
  /**
   * @register user with facebook account
   * @param Request $request
  */
  public function registerWithFacebook(Request $request){

  }
}
