<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materials extends Model
{
    use SoftDeletes;

    protected $table = 'materials';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable =
    [
        'courses_id',
        'title',
        'file_path',
    ];

    // relasi one-to-many ke Courses model
    public function courses()
    {
        return $this->belongsTo(Courses::class, 'courses_id', 'id');
    }
}
