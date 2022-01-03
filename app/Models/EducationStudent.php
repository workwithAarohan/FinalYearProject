<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationStudent extends Model
{
    use HasFactory;

    protected $fillable = ['board_university', 'passed_year', 'roll_number', 'marks_obtained', 'percentage', 'cgpa', 'user_id'];

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
