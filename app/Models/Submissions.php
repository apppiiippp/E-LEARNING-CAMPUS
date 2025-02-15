<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Submissions extends Model
{
    use SoftDeletes;

    protected $table = 'submissions';

    protected $dates =[
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'assignments_id',
        'students_id',
        'file_path',
        'score',
    ];

    // relasi one-to-many ke Assignments model
    public function assignments()
    {
        return $this->belongsTo(Assignments::class, 'assignments_id', 'id');
    }

    //relasi one-to-many ke User model
    public function students()
    {
        return $this->belongsTo(User::class, 'students_id', 'id');
    }
}
