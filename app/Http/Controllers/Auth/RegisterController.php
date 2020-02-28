<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use JWTAuth;

class RegisterController extends Controller
{
    use RegistersUsers;


    protected function create(Request $request){

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users|max:32',
            'password' => 'required', 'string', 'min:4', 'max:180',
            'role' => ['required', 'numeric','digits_between:1,20'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::fecthUserData($request);

        if(!$user) return response()->json("Database Error",500);

        $token=JWTAuth::fromUser($user);

        return response()->json(['User Succesfully Created'],200);
    }
}
