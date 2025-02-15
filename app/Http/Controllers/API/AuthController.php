<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {

            // Validasi
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name'      => 'required|string|max:255',
                    'email'     => 'required|string|email|unique:users',
                    'password'  => 'required|string',
                    'role'      => 'required|in:Mahasiswa,Dosen',
                ]
            );

            // Jika validasi gagal
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'errors' => $validateUser->errors()
                ], 422);
            }

            // membuat akun pengguna baru
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role'      => $request->role,
            ]);

            // membuat token
            $token = $user->createToken('api_token')->plainTextToken;

            // response dari server
            return response()->json([
                'status' => true,
                'message' => 'Pendaftaran Akun Berhasil ',
                'data' => [
                    'id'    => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'token' => $token
                ],

            ], 201);
        } catch (\Exception  $e) {

            // Jika terjadi kesalahan, kembalikan respons JSON dengan status gagal
            return response()->json([
                'status' => false,
                'message' => 'Terjadi Kesalahan',
                'error' => $e->getMessage()
            ], 500);
        };
    }

    public function login(Request $request)
    {
        try {
            //validasi
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email'     => 'required|string|email',
                    'password'  => 'required|string',
                ]
            );

            // jika validasi gagal, return error response
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'errors' => $validateUser->errors()
                ], 422);
            }

            //cek email
            $user = User::where('email', $request->email)->first();

            // cek password
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email atau kata sandi yang Anda masukkan tidak sesuai. Silakan coba lagi.',
                ], 401);
            }

            // buat token
            $token = $user->createToken('api_token')->plainTextToken;

            // response dari server
            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil',
                'data' => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                    'role'  => $user->role,
                    'token' => $token,
                ],
            ], 200);
        } catch (\Exception  $e) {

            // Jika terjadi kesalahan, kembalikan respons JSON dengan status gagal
            return response()->json([
                'status' => false,
                'message' => 'Terjadi Kesalahan',
                'error' => $e->getMessage()
            ], 500);
        };
    }

    public function logout(Request $request)
    {
        try {

            // Revoke token
            $request->user()->tokens()->delete();

            // response dari server
            return response()->json([
                'status' => true,
                'message' => 'Berhasil Logout',
            ], 200);

        } catch (\Exception  $e) {

            // Jika terjadi kesalahan, kembalikan respons JSON dengan status gagal
            return response()->json([
                'status' => false,
                'message' => 'Terjadi Kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
