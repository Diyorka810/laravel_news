<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    protected $fillable = [
        'user_post_id',
        'language',
        'title',
        'content',
    ];

    public function post()
    {
        return $this->belongsTo(UserPost::class, 'user_post_id');
    }
}