<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    use HasFactory;

    protected $table = 'course_details';

    protected $fillable = ['course_id', 'slug', 'title', 'image','description', 'objective'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
