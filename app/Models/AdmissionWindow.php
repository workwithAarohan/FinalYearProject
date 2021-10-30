<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionWindow extends Model
{
    use HasFactory;

    protected $fillable = ['batch_id', 'course_id', 'created_by', 'is_open'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
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
