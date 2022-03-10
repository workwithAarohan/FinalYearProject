<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['classroom_id', 'attendance_date', 'created_by', 'topic_covered', 'teacher_id'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
