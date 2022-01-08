<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_name', 'subject_code', 'credit_hrs', 'is_elective', 'syllabus', 'course_id', 'semester_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function batch_classrooms($batch_id)
    {
        return $this->hasMany(Classroom::class)->where('batch_id', $batch_id);
    }


}
