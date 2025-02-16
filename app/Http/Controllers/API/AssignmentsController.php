<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Assignments;
use Illuminate\Http\Request;
use App\Models\CoursesStudents;
use App\Http\Controllers\Controller;
use App\Mail\AssignmentNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Assignments\AssignmentsRequest;
use App\Http\Resources\Assignments\AssignmentsResource;

class AssignmentsController extends Controller
{
    public function createAssignment(AssignmentsRequest $request)
    {

        // Cek apakah user sudah login
        $user = Auth::user();

        // Cek role user (hanya dosen yang bisa menambahkan tugas)
        if ($user->role == 'Mahasiswa') {
            return response()->json([
                'status' => false,
                'message' => 'Anda Tidak Memiliki Akses',
            ], 401);
        }

        // Format deadline dengan Carbon
        $deadline = Carbon::parse($request->deadline)->format('Y-m-d');

        // Simpan tugas baru
        $assignment = Assignments::create([
            'courses_id' => $request->courses_id,
            'title'      => $request->title,
            'description' => $request->description,
            'deadline'   => $deadline,
        ]);

        // Kirim email ke alamat statis untuk percobaan
        try {
            Mail::to('mahasiswa@gmail.com')->send(new AssignmentNotification($assignment));
        } catch (\Exception $e) {
            return response()->json([
                'status' => true,
                'message' => 'Tugas berhasil ditambahkan, tetapi email gagal dikirim.',
                'error' => $e->getMessage(),
                'assignment' => new AssignmentsResource($assignment),
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Tugas berhasil ditambahkan dan email telah dikirim',
            'assignment' => new AssignmentsResource($assignment),
        ], 200);
    }
}
