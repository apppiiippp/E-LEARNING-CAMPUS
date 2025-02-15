<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // relasi one-to-many ke Courses model
    public function course_lecturer()
    {
        return $this->hasMany(Courses::class, 'lecturer_id');
    }

   // relasi many-to-many ke Courses model
   public function courses()
   {
       return $this->belongsToMany(Courses::class);
   }

   // relasi one-to-many ke CourseStudent model
   public function course_student()
   {
       return $this->hasMany(CourseStudent::class, 'students_id');
   }


   // relasi one-to-many ke Submissions model
   public function submissions()
   {
       return $this->hasMany(Submissions::class,'students_id');
   }

   // relasi one-to-many ke Discussions model
   public function discussions()
   {
       return $this->hasMany(Discussions::class, 'user_id');
   }

   // relasi one-to-many ke Replies model
   public function replies()
   {
       return $this->hasMany(Replies::class, 'user_id');
   }
}
