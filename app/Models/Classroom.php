<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['room_name', 'description', 'image', 'batch_id', 'subject_id', 'is_active', 'created_by'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function student_points()
    {
        return $this->hasMany(AssignmentPoint::class);
    }

}
