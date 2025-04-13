<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function choices() {
        return $this->hasMany(Choice::class);
    }
}