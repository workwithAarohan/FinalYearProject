<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'symbol_number', 'registration_number', 'college_email', 'course_id', 'batch_id', 'semester_id', 'admission_date', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function attendances()
    {
        return $this->belongsToMany(Attendance::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    public function student_points()
    {
        return $this->hasMany(AssignmentPoint::class);
    }
}
