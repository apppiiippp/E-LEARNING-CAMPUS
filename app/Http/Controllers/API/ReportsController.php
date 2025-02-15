<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Courses;
use App\Models\Assignments;
use App\Models\Submissions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function reportCourses()
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'Anda harus login untuk melihat laporan',
            ], 401);
        }

        $data = Courses::withCount('courses_students')->get();

        return response()->json([
            'status' => true,
            'message' => 'Laporan berhasil ditampilkan',
            'data' => $data,
        ], 200);
    }

    public function reportsGraded()
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'Anda harus login untuk melihat laporan',
            ], 401);
        }

        $graded = Submissions::whereNotNull('score')->count();
        $ungraded = Submissions::whereNull('score')->count();

        return response()->json([
            'status' => true,
            'message' => 'Laporan berhasil ditampilkan',
            'data' => [
                'graded' => $graded,
                'ungraded' => $ungraded,
            ],
        ], 200);
    }

    public function reportStudent($id)
    {
        // Cari mahasiswa berdasarkan ID
        $student = User::where('role', 'Mahasiswa')->find($id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Mahasiswa tidak ditemukan',
            ], 404);
        }

        $total_tugas = Assignments::count();

        $total_nilai = Submissions::where('students_id', $id)->count('score');

        return response()->json([
            'status' => true,
            'message' => 'Laporan berhasil ditampilkan',
            'data' => [
                'student' => $student->only(['id', 'name', 'email']),
                'tugas' => [
                    'jumlah_tugas' => $total_tugas,
                ],
                'nilai mahasiswa' => [
                    'jumlah_nilai' => $total_nilai
                ]
            ],
        ], 200);
    }
}
