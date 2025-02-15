<?php

namespace App\Http\Controllers\API;

use App\Models\Materials;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Materials\MaterialsRequest;
use App\Http\Resources\Materials\MaterialsResource;

class MaterialsController extends Controller
{
    public function materials(MaterialsRequest $request)
    {
        try {
            //cek login
            $user = Auth::user();

            //cek role
            if ($user->role == 'Mahasiswa') {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda Tidak Memiliki Akses',
                ], 401);
            }

            //upload file
            $upload_file = null;

            if ($request->hasFile('file_path')) {
                $upload_file = $request->file('file_path')->store('uploads/material', 'public');
            }

            $materials = Materials::create([
                'courses_id' => $request->courses_id,
                'title' => $request->title,
                'file_path' => $upload_file,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Material berhasil diupload',
                'data' => new MaterialsResource($materials),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi Kesalahan: ',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function downloadMaterial($id)
    {
        try {
            $user = Auth::user();

            if ($user->role == 'Dosen') {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda Tidak Memiliki Akses',
                ], 401);
            }

            $materials = Materials::find($id);

            if (!$materials) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Material Tidak Ditemukan',
                ], 404);
            }

            $fileUrl = Storage::url($materials->file_path);

            return response()->json([
                'status' => true,
                'message' => 'Material berhasil diunduh',
                'file_path' => $fileUrl,
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Terjadi Kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
