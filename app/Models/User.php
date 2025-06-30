<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_name',
        'password',
        'first_name',
        'last_name',
        'email',
        'sex',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
