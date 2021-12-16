<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        try {
            $user = User::create($data);
            Log::notice("Register successful user " .$data['name'] );
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => 'register has error'], 401);
        }
        return response()->json(['user' => $user], Response::HTTP_OK);
    }

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json(['errors' => 'Wrong account or password'], 401);
        }
        $user = Auth::user();
        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function logout(Request $request)
    {
//        if ($token = $request->bearerToken()) {
//            $model = Sanctum::$personalAccessTokenModel;
//            $accessToken = $model::findToken($token);
//            $accessToken->delete();
//        }
//        return response()->json(['msg' => 'Logout Successful']);
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return response()->json(['msg' => 'Logout Successful']);
    }
}
