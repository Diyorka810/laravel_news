<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'image_link',
        'is_published',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function translations()
    {
        return $this->hasMany(PostTranslation::class);
    }

    public function translation(): ?PostTranslation
    {
        $lang = $lang ?? app()->getLocale();

        return $this->translations->firstWhere('locale', $lang)
            ?? $this->translations->first();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }
}
