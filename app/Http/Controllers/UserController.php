<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::get();

        return response()->json($user);
    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6'
        ]);
        
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['message' => 'Register Success'],201);
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email',$request->email)->first();
        if(!$user)
        {
            return response()->json(['message'=>'Login Failed'],401);
        }

        $password = Hash::check($request->password, $user->password);
        if(!$password)
        {
            return response()->json(['message'=>'Password wrong'],401);
        }
        $token =bin2hex(random_bytes(40));
        $user->update([
            'token' => $token
        ]);

        return response()->json($user);
    }
}
