<?php


namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'phone'     => 'required',
                'password'  => 'required|string'
            ]);

            // Validation Fails
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            // Authentication Check
            if(!Auth::attempt($request->only(['phone', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Phone & Password does not match with our record.',
                ], 401);
            }
            // Response Currect User
            $user = User::where('phone', $request->phone)->first();
            return response()->json([
                'status' => true,
                'message' => 'User logged in success',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'token_type' => 'Bearer',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function loggout(Request $request)
    {
        try {
            $user = Auth::user();
            $user->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'User log out success'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
