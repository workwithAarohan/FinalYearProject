<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'temporaryAddress',
        'permanentAddress',
        'avatar',
        'address',
        'phone',
        'dob',
        'gender',
        'nationality',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Mutator
     * Hashing the password
     *
     */
    public function setPasswordAttribute($data)
    {
        $this->attributes['password'] = Hash::make($data);
    }

    public function course()
    {
        return $this->hasMany(Course::class, 'created_by');
    }

    public function batch()
    {
        return $this->hasMany(Batch::class, 'created_by');
    }

    public function semester()
    {
        return $this->hasMany(Semester::class, 'created_by');
    }

    public function classroomCreatedBy()
    {
        return $this->hasMany(Semester::class, 'created_by');
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function admissionWindow()
    {
        return $this->hasMany(AdmissionWindow::class, 'created_by');
    }

    public function education()
    {
        return $this->hasMany(EducationStudent::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, 'created_by');
    }

    public function subTopics()
    {
        return $this->hasMany(SubTopic::class, 'created_by');
    }

    public function assignements()
    {
        return $this->hasMany(Assignment::class, 'created_by');
    }

    public function attendances()
    {
        return $this->hasMany(Assignment::class, 'created_by');
    }

    public function studentinfo()
    {
        return $this->hasOne(StudentInformation::class);
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class,'user_role');
    // }

    // public function attendances()
    // {
    //     return $this->hasMany(Attendance::class, 'teacher_id');
    // }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'created_by');
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'created_by');
    }

    public function examination()
    {
        return $this->hasMany(Examination::class, 'created_by');
    }
}
