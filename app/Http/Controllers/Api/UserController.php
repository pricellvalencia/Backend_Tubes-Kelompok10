<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function register(Request $request)
    {
        $registrationData = $request->all();

        $validate = Validator::make($registrationData, [
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email',
            'tglLahir' => 'required',
            'noPhone' => 'required|regex:/^(08)[0-9]{9,11}$/',

        ]);
        if ($validate->fails())
            return response(['message' => $validate->errors()->first()], 400);

        $registrationData['password'] = bcrypt($request->password);

        $user = User::create($registrationData);

        event(new Registered($user));
        auth()->login($user);

        return redirect()->route('verification.notice')->with(['message' => 'Registration Success, Please register your email', 'user' => $user], 200);
    }

    public function login(Request $request)
    {
        $loginData = $request->all();

        $validate = Validator::make($loginData, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()->first()], 400);

        if (!Auth::attempt($loginData))
            return response(['message' => 'Invalid Credentials'], 401);

        $user = User::where('email', $request->email)->first();
        if($user->email_verified_at == null) {
            return response(['message'=>'Please verify your email'], 401);
        } else {
            return response(['message'=>'Authenticed','user'=>$user]);
        }

        return response([
            'message' => 'Authenticated',
            'user' => $user,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!is_null($user)) {
            return response([
                'message' => 'Berhasil Mendapatkan Data User',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'Data User Tidak Ditemukan',
            'data' => null
        ], 404);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response([
                'message' => 'Data User Tidak Ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'username' => 'required',
            'email' => 'required',
            'tglLahir' => 'required',
            'noHp' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $user->username = $updateData['username'];
        $user->email = $updateData['email'];
        $user->tglLahir = $updateData['tglLahir'];
        $user->noHp = $updateData['noHp'];

        if ($user->save()) {
            return response([
                'message' => 'Data User Berhasil diUpdate',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'Data User Gagal diUpdate',
            'data' => null
        ], 400);
    }
}
