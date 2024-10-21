<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return  response()->json([
                'Validation Error.' => $validator->errors()
            ]);
        }

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $user = Auth::user();

            $success['token'] = $user->createToken('Login')->accessToken;


            return response()->json([
                'success' => $success
            ], 200);


        }

        return response()->json([
            'error' => 'Unauthorized'
        ], 401);

    }

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return  response()->json([
                'Validation Error.' => $validator->errors()
                ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $success['token'] =  $user->createToken('Login')->accessToken;

        return response()->json([
            'success'=> 'kullanıcı oluşturuldu.',
            'token' => $success
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {

            Auth::user()->authUserToken()->delete();
            return response()->json(['message' => 'Success Logout.'],200);


            // Aktif kullanıcının token'ını alıyoruz
            $token = Auth::user()->authUserToken()->where('id', $request->user()->token()->id)->first();

            if ($token) {
                // Token'ı sil
                $token->delete();
                return response()->json(['message' => 'Success Logout.'], 200);
            }
            return response()->json(['error' => 'Token not found'], 404);
        }
        return response()->json([
            'error' => 'Unauthorized'
        ], 401);
    }
}
