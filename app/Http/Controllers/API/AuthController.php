<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function createStaff(Request $request)
    {
        try {
            //Validated
            $validateStaff = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'street' => 'required',
                    'city' => 'required',
                    'phone' => 'required|numeric',
                    // 'password' => 'required',
                ]
            );
            if ($validateStaff->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateStaff->errors(),
                ], 401);
            }
            $staff = Staff::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'lastname' => $request->lastname,
                'street' => $request->street,
                'city' => $request->city,
                'phone' => $request->phone,

            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $staff->createToken('API TOKEN')->plainTextToken,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function loginStaff(Request $request)
    {
        try {
            $validateStaff = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required',
                ]
            );
            if ($validateStaff->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateStaff->errors(),
                ], 401);
            }
            if (! Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }
            $staff = Staff::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $staff->createToken('API TOKEN')->plainTextToken,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
