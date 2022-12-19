<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerificationController extends Controller
{
    //
    public function notice()
    {
        return response()->json([
            'message' => 'Please verify your email'
        ], 200);
    }

    public function verify(Request $request)
    {
        $idUser = $request->route('id');
        $user = User::findOrFail($idUser);
        $user->update([
            'email_verified_at' => now()
        ]);

        return response()->json([
            'message' => 'Email verified'
        ], 200);
    }
}
