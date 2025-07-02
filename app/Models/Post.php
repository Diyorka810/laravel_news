<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Filters\PostFilter;


class Post extends Model
{
    use SoftDeletes;
    use HasFactory;

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

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function coverImage()
    {
        return $this->hasOne(PostImage::class)->where('is_cover', true);
    }

    public static function filtered(Request $request)
    {
        $query = static::query()->with('translations', 'coverImage');
        $filter = new PostFilter($query, $request);

        return $filter->apply()->latest('id');
    }
}
