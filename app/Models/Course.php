<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'course_name',
    ];

    protected $table = 'courses';


    // １対１ hasMany設定
    public function post()
    {
        return $this->hasMany('App\Models\Post');
    }

    // １対１ hasMany設定
    public function customer()
    {
        return $this->hasMany('App\Models\Customer');
    }
}
