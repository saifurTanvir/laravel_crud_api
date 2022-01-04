<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function registration(){
        //  $DATA2 = request()->all();

        //  return response()->json($DATA2);

        $data = request()->validate([
            'name' => ['required', 'string'],
            'email' => ['required'],
            'password' => ['required']
        ]);

        $data['password'] = Hash::make(request()->password);

        $user = User::create($data);

        $token = $user->createToken('api token')->accessToken;

        return response()->json($token);
    }

    public function login(){
        $data = request()->validate([
            'email' => 'required|string|max:255|email',
            'password' => 'required|string|min:6'
        ]);

        $user = User::where('email', $data['email'])->first();

        if($user){
            if(Hash::check($data['password'], $user->password)){
                $token = $user->createToken('api token')->accessToken;
                return response()->json($token);
            }else{
                return response()->json('Password mismatch.');
            }
        }else{
            return response()->json('User does not exist.');
        }
    }

    public function logout(){
        $token = request()->user()->token();
        $token->revoke();
        return response()->json('You have successfully logged out.');
    }
}
