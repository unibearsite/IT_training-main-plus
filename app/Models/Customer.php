<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use App\Casts\HashMake;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\Customer as Authenticatable;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Customer extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'name',
        'lesson_id',
        'course_id',
        'chapter_id',
        'email',
        'password',
        'last_login_at',
    ];

    protected $dates = [
        'last_login_at',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => HashMake::class,
        'email_verified_at' => 'datetime',
    ];
    // １対１ belongsTo設定
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

}
