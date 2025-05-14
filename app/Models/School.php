<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolFactory> */
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'password'
    ];
    public function students()
    {
        return $this->hasMany(User::class);
    }
}
