<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'instruction', 'points', 'due_date', 'topic_id', 'classroom_id', 'created_by'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function student_points()
    {
        return $this->hasMany(AssignmentPoint::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)
                ->withPivot(['points_obtained','is_checked', 'file']);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
