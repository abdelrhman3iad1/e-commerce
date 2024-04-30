<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|email|string|unique:users,email",
            "password" => "required|min:8|confirmed"
        ]);
        if ($validation->fails()) {
            return response()->json([
                "Errors" => $validation->errors()
            ], 301);
        } else {
            $password = bcrypt($request->password);
            $access_token = Str::random(64);
            User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => $password,
                "access_token" => $access_token
            ]);
            return response()->json([
                "Msg" => "Registration succeeded",
                "access_token" => $access_token
            ], 201);
        }
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "email" => "required|email|max:255",
            "password" => "required|string|min:8"
        ]);
        if ($validation->fails()) {
            return response()->json([
                "Errors" => $validation->errors()
            ], 301);
        }else{
            $user = User::where("email",$request->email)->first;
            if($user !== null){
                $verifiedPass = Hash::check($request->password,$user->password);
                if($verifiedPass){
                    $access_token = Str::random(64);
                    $user->update([
                        "access_token"=>$access_token
                    ]);
                    return response()->json([
                        "Success" => "You logged in successfully",
                        "access_token"=>$access_token
                    ], 200);
                }else{
                    return response()->json([
                        "Msg" => "Credintial Not correct"
                    ], 404);
                }
            }else{
                return response()->json([
                    "Msg" => "Credintial Not correct"
                ], 404);
            }
        }
    }
    public function logout(Request $request){
        $access_token = $request->header("access_token");
        if($access_token!==null){
                    $user = User::where("access_token",$access_token)->first();
                    if($user!==null){
                        $user->update([
                            "access_token"=>null
                        ]);
                        return response()->json([
                            "msg"=>"Logged Out Successfully"
                        ],200);
                    }else{
                        return response()->json([
                            "msg"=>"Access Token Not correct"
                        ],404);
        }}else{
            return response()->json([
                "msg"=>"You Must Be Logged In First"
            ],301);
        }
    }


}
