<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RegistrationNotification;

class AuthController extends Controller
{
    public function test(Request $request)
    {
        return 'ABC234';
    }
    public function register(Request $request)
    {
        
        $fields = $request->validate([
            "name"=>"required",
            "email"=> "required|email",
            "password"=> "required|confirmed",
            "phone_number"=> "required|string",
        ]);
        
        $user = User::create($fields);
        $token = $user->createToken($request->name);
        // return $user;
        $user->notify(new RegistrationNotification());
        return ['user' => $user, 'token'=>$token->plainTextToken];

        
    }
    public function login(Request $request)
    {
       
         $credentials = $request ->validate([
            "email"=> "required|email|exists:users",
            "password"=> "required|confirmed",
        ]);
        $user = User::where("email", $credentials["email"])->first();
        if(!$user || !Hash::check($credentials["password"], $user->password))
        {
            return ["message"=> "The provided credentials are incorrect"];
        }

        $token  = $user->createToken($user->name);
        return [
            "user"=> $user,
            "token"=> $token->plainTextToken,
        ];


    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return ["message"=> "You're logged Out"];
    }
}
