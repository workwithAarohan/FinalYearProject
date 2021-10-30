<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['course_name', 'created_by', 'is_active'];

    public function courseDetails()
    {
        return $this->hasOne(CourseDetail::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function admissionWindows()
    {
        return $this->hasMany(AdmissionWindow::class);
    }
}
