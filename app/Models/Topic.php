<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Assign;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['topic_title', 'classroom_id', 'credit_hrs', 'created_by'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function subTopics()
    {
        return $this->hasMany(SubTopic::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

}
