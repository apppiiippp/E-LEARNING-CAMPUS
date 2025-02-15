<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignments extends Model
{
    use SoftDeletes;

    // deklarasi tabel
    protected $table = 'assignments';


    // deklarasi waktu
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // deklarasi field yang diisi
    protected $fillable =[
        'courses_id',
        'title',
        'description',
        'deadline'
    ];

    // relasi one-to-many ke Courses model
    public function courses()
    {
        return $this->belongsTo(Courses::class, 'courses_id', 'id');
    }

    // relasi one-to-many ke Submissions model
    public function submissions()
    {
        return $this->hasMany(Submissions::class, 'assignments_id');
    }

}
