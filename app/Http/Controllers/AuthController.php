<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
            'gender' => 'required|string',
        ]);

        $user = User::create([
            'firstName' => $validate['firstName'],
            'lastName' => $validate['lastName'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
            'phoneNumber' => $validate['phoneNumber'],
            'gender' => $validate['gender'],
        ]);

        // $token = $user->createToken($request->userAgent())->plainTextToken;
        $respone = [
            'user' => $user,
            'message' => 'Resgister Success'
        ];

        return response($respone);
    }

    public function login(Request $request){
        $validate = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        // ตรวจสอบ User ที่  login เข้ามาว่ามี user นี้ใน Database หรือไม่
        $user = User::where('email', $validate['email'])->first();

        // ตรวจสอบเงื่อนไขการ Login
        if (!$user || !Hash::check($validate['password'], $user->password)) {
            $response = [
                'message' => 'Email or Password incorrect',
            ];
            return response($response,401);
        } else {
            // ลบ Token เก่าที่ค้างอยู่
            $user->tokens()->delete();

            // สร้าง Token ใหม่
            // userAgent() คือ method ที่ใช้สำหรับดึง Browser ว่ายิง API มาจาก Browser ไหน
            $token = $user->createToken($request->userAgent())->plainTextToken;
            
            $response = [
                'user' => $user,
                'token' => $token,
                'message' => 'Login Success'
            ];
            return response($response,201);
        }
    }
    
    public function logout(Request $request){
        
        $request->user()->currentAccessToken()->delete();
        
        $respone = [
            'message' => 'Logout Success'
        ];
        return response($respone,200);
    }

}
