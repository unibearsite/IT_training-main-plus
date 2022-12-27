<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Lesson extends Model
{
    use HasFactory;
    protected $table = "lessons";

    protected $fillable = [
        'title',
        'estimated_time',
        'course_id',
        'lesson_id',
    ];

    public static function getLesson_id()
    {
        $lesson_id = Lesson::select('lesson_id')->get();
        return $lesson_id;
    }

}
