<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function translation(): ?CategoryTranslation
    {
        $lang = $lang ?? app()->getLocale();

        return $this->translations->firstWhere('locale', $lang)
            ?? $this->translations->first();
    }
}
