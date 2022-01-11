<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = ['firstname','lastname','email',
        'temporaryAddress','permanentAddress','pp_photo','address','phone','dob',
        'gender','nationality', 'blood_group', 'father_name', 'mother_name',
        'admission_window_id'
    ];

    public function admission_window()
    {
        return $this->belongsTo(AdmissionWindow::class);
    }

    public function admission_educations()
    {
        return $this->hasMany(AdmissionEducation::class);
    }
}
