<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $table = 'examination';

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)
                ->withPivot(['full_mark', 'pass_mark', 'is_checked', 'teacher_id']);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
