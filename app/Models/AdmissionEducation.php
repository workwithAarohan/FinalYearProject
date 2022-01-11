<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionEducation extends Model
{
    use HasFactory;

    protected $fillable = ['admission_id', 'board', 'symbol_number','passed_year', 'percentage_cgpa'];

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }
}
