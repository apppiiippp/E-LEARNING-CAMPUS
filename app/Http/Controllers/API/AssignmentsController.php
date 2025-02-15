<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Assignments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Assignments\AssignmentsRequest;
use App\Http\Resources\Assignments\AssignmentsResource;

class AssignmentsController extends Controller
{
    public function createAssignment(AssignmentsRequest $request) {
         //check login
         $user = Auth::user();

         // cek role
         if ($user->role == 'Mahasiswa') {
             return response()->json([
                 'status' => false,
                 'message' => 'Anda Tidak Memiliki Akses',
             ], 401);
         }

         $deadline = Carbon::createFromFormat('d-m-Y', $request->deadline)->format('Y-m-d');

         // store assignments
         $assignment = Assignments::create([
             'courses_id' => $request->courses_id,
             'title'      => $request->title,
             'description' => $request->description,
             'deadline'   => $deadline,
         ]);


         return response()->json([
             'status' => true,
             'message' => 'Assignment berhasil ditambahkan',
             'assignment' => new AssignmentsResource($assignment),
         ], 200);
    }
}
