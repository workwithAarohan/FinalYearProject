<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentPoint extends Model
{
    use HasFactory;

    protected $fillable = ['classroom_id', 'assignment_id', 'student_id', 'pointsObtained', 'is_returned'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
