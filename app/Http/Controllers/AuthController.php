<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $validate = $request->validate([
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'phoneNumber' => 'required|string',
            'gender' => 'required|string'
        ]);

        $user = User::create([
            'firstName' => $validate['firstName'],
            'lastName' => $validate['lastName'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
            'phoneNumber' => $validate['phoneNumber'],
            'gender' => $validate['gender']
        ]);

        $token = $user->createToken('myDevice')->plainTextToken;
        $respone = [
            'user' => $user,
            'token' => $token
        ];

        return response($respone);
    }

    public function login(Request $request){
        $validate = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        // ตรวจสอบ User ที่  login เข้ามาว่ามี user นี้หรือไม่
        $user = User::where('email', $validate['email'])->first();

        // ตรวจสอบเงื่อนไขการ Login
        if (!$user || !Hash::check($validate['password'], $user->password)) {
            $response = [
                'message' => 'Email or Password incorrect'
            ];
            return response($response);
        } else {
            // ลบ Token เก่าที่ค้างอยู่
            // $user->tokens()->delete();

            // สร้าง Token ใหม่
            $token = $user->createToken('myDevice')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response($response);
        }
    }
}
