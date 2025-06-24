<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    protected $fillable = [
        'user_post_id',
        'locale',
        'title',
        'content',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'user_post_id');
    }
}