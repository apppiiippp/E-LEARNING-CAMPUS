<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Replies extends Model
{
    use SoftDeletes;

    protected $table = 'replies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable =
    [
        'discussions_id',
        'user_id',
        'content'
    ];

    // relasi one-to-many ke Discussions model
    public function discussion()
    {
        return $this->belongsTo(Discussions::class, 'discussions_id', 'id');
    }

    // relasi one-to-many ke User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
