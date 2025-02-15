<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courses extends Model
{

    // soft deletes
    use SoftDeletes;

    // deklarasi tabel
    protected $table = 'courses';


    // deklarasi waktu
    protected $dates =[
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // deklarasi field yang diisi
    protected $fillable = [
        'lecturer_id',
        'name',
        'description'
    ];

    // relasi many-to-many ke User model
    public function students()
    {
        return $this->belongsToMany(User::class);
    }

    // relasi one-to-many ke CoursesStudent model
    public function courses_students()
    {
        return $this->hasMany(CoursesStudents::class, 'courses_id');
    }

    // relasi one-to-many ke User model
    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id', 'id');
    }

    // relasi one-to-many ke Materials model
    public function materials()
    {
        return $this->hasMany(Materials::class, 'courses_id');
    }

    // relasi one-to-many ke Assignments model
    public function assignments()
    {
        return $this->hasMany(Assignments::class, 'courses_id');
    }


    // relasi one-to-many ke Discussions model
    public function discussions()
    {
        return $this->hasMany(Discussions::class, 'courses_id');
    }
}
