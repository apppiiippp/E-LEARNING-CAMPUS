<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discussions extends Model
{
    use SoftDeletes;

    protected $table = 'discussions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable =
    [
        'courses_id',
        'user_id',
        'content'
    ];

    // relasi one-to-many ke Replies model
    public function replies()
    {
        return $this->hasMany(Replies::class, 'discussions_id');
    }

    //  relasi one-to-many ke Courses model
    public function courses()
    {
        return $this->belongsTo(Courses::class, 'courses_id', 'id');
    }

    // relasi one-to-many ke User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
