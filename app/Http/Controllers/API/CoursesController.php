<?php

namespace App\Http\Controllers\API;

use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\CoursesStudents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Courses\CoursesRequest;
use App\Http\Resources\Courses\CoursesResource;
use App\Http\Resources\CoursesStudents\CoursesStudentsResource;

class CoursesController extends Controller
{

    public function index()
    {
        try {

            // mengambil semua data courses
            $courses = Courses::orderBy('created_at', 'desc')->get();

            // mengembalikan data courses dalam bentuk JSON
            return response()->json([
                'status'  => true,
                'message' => 'Berhasil Menampilkan Data Courses',
                'data'    => CoursesResource::collection($courses),
            ]);
        } catch (Exception $e) {

            // mengembalikan pesan error jika terdapat kesalahan
            return response()->json([
                'status' => false,
                'message' => 'Terjadi Kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createCourses(CoursesRequest $request)
    {
        try {

            //cek login
            $user = Auth::user();

            //cek yang login apakah role mahasiswa atau dosen
            if ($user->role == 'Mahasiswa') {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda Tidak Memiliki Akses',
                ], 401);
            }

            // membuat courses baru
            $courses = Courses::create([
                'name' => $request->name,
                'description' => $request->description,
                'lecturer_id' => $request->lecturer_id,
            ]);

            // mengembalikan data courses baru dalam bentuk JSON
            return response()->json([
                'status'  => true,
                'message' => 'Berhasil Menambahkan Data Courses',
                'data'    => new CoursesResource($courses),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi Kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateCourses(CoursesRequest $request, $id)
    {
        try {

            //cek login
            $user = Auth::user();

            // cek yang login apakah role mahasiswa atau dosen
            if ($user->role == 'Mahasiswa') {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda Tidak Memiliki Akses',
                ], 401);
            }

            // cari courses yang akan diupdate
            $courses = Courses::find($id);

            // update data courses
            $courses->update([
                'name' => $request->name,
                'description' => $request->description,
                'lecturer_id' => $request->lecturer_id,
            ]);

            // mengembalikan data courses yang sudah diupdate dalam bentuk JSON
            return response()->json([
                'status'  => true,
                'message' => 'Berhasil Mengubah Data Courses',
                'data'    => new CoursesResource($courses),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi Kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteCourses($id)
    {

        try {

            //check login user
            $user = Auth::user();

            //check role user
            if ($user->role == 'Mahasiswa') {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda Tidak Memiliki Akses',
                ], 401);
            }

            // ambil data courses berdasarkan id
            $courses = Courses::find($id);

            // jika data courses tidak ditemukan
            if (!$courses) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ], 404);
            }

            // hapus courses
            $courses->delete();

            // return response
            return response()->json([
                'status' => true,
                'message' => 'Data courses berhasil dihapus',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi Kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function enrollCourse($id)
    {
        try {
            //check login user
            $user = Auth::user();

            // check role user
            if ($user->role == 'Dosen') {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda Tidak Memiliki Akses',
                ], 401);
            }

            // find course by id
            $courses = Courses::find($id);

            // if course is not found
            if (!$courses) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data courses tidak ditemukan',
                ], 404);
            }

            // cek jika mahasiswa sudah terdaftar pada courses tersebut
            if (CoursesStudents::where('courses_id', $id)->where('students_id', $user->id)->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda sudah terdaftar di mata kuliah ini'
                ], 400);
            }

            // buat data mahasiswa untuk mendaftar ke courses
            $data = CoursesStudents::create([
                'students_id' => $user->id,
                'courses_id' => $id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil mendaftar ke mata kuliah',
                'data' => new CoursesStudentsResource($data),
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
