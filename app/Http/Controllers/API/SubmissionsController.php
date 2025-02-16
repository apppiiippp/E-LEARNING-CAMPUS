<?php

namespace App\Http\Controllers\API;

use App\Models\Submissions;
use Illuminate\Http\Request;
use App\Mail\GradeNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Submissions\SubmissionsRequest;
use App\Http\Resources\Submissions\SubmissionsResource;

class SubmissionsController extends Controller
{
    public function createdSubmissions(SubmissionsRequest $request)
    {
        try {

            $user = Auth::user();

            if ($user->role == 'Dosen') {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda Tidak Memiliki Akses',
                ], 401);
            }

            // upload file
            $upload_file = null;

            if ($request->hasFile('file_path')) {
                $upload_file = $request->file('file_path')->store('uploads/submissions', 'public');
            }

            // buat data submissions
            $submission = Submissions::create([
                'assignments_id' => $request->assignments_id,
                'students_id' => $user->id,
                'file_path' => $upload_file,

            ]);

            return response()->json([
                'status' => true,
                'message' => 'Submission berhasil diupload',
                'submission' => new SubmissionsResource($submission),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi Keselahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function gradeSubmissions(Request $request, $id)
    {
        //check user login
        $user = Auth::user();

        //check if user is lecturer
        if ($user->role == 'Mahasiswa') {
            return response()->json([
                'status' => false,
                'message' => 'Anda Tidak Memiliki Akses',
            ], 401);
        }

        // find the submission
        $submission = Submissions::find($id);
        if (!$submission) {
            return response()->json([
                'status' => false,
                'message' => 'Data Submission Tidak Ditemukan',
            ], 404);
        }

        // update the grade
        $submission->score = $request->score;
        $submission->save();


        Mail::to('mahasiswa@gmail.com')->send(new GradeNotification($submission));

        return response()->json([
            'status' => true,
            'message' => 'Submission berhasil diupdate dengan nilai ' . $request->score,
            'data' => new SubmissionsResource($submission),
        ], 200);
    }
}
