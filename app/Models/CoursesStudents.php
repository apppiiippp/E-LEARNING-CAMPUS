<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursesStudents extends Model
{
    use SoftDeletes;

    // deklarasi tabel
    protected $table = 'courses_students';

    // deklarasi waktu
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // deklarasi field yang diisi
    protected $fillable = [
        'courses_id',
        'students_id'
    ];

    // relasi one-to-many ke Courses model
    public function courses()
    {
        return $this->belongsTo(Courses::class, 'courses_id', 'id');
    }

    // relasi one-to-many ke User model
    public function students()
    {
        return $this->belongsTo(User::class, 'students_id', 'id');
    }
}
