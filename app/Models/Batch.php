<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['batch_name', 'batch_description', 'course_id', 'year', 'is_active'];

    public function users()
    {
        return $this->hasMany(StudentInformation::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
