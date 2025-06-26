<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostTranslation;
use App\Filters\PostFilter;

class PostFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_filters_by_category()
    {
        $category = Category::factory()->create();
        $postInCategory = Post::factory()->hasAttached($category)->create();
        $postOutside = Post::factory()->create();

        $request = Request::create('/posts', 'GET', [
            'category' => $category->id,
        ]);

        $builder = Post::query();
        $filtered = (new PostFilter($builder, $request))->apply()->get();

        $this->assertTrue($filtered->contains($postInCategory));
        $this->assertFalse($filtered->contains($postOutside));
    }

    public function test_it_filters_by_search()
    {
        $post = Post::factory()->create();
        PostTranslation::factory()->create([
            'post_id' => $post->id,
            'title' => 'Unique Search Title',
            'content' => 'Some irrelevant content'
        ]);

        $anotherPost = Post::factory()->create();
        PostTranslation::factory()->create([
            'post_id' => $anotherPost->id,
            'title' => 'Random title',
            'content' => 'Other stuff'
        ]);

        $request = Request::create('/posts', 'GET', [
            'q' => 'Unique Search',
        ]);

        $builder = Post::query();
        $filtered = (new PostFilter($builder, $request))->apply()->get();

        $this->assertTrue($filtered->contains($post));
        $this->assertFalse($filtered->contains($anotherPost));
    }

    public function test_it_applies_both_filters()
    {
        $category = Category::factory()->create();
        $post = Post::factory()->hasAttached($category)->create();
        PostTranslation::factory()->create([
            'post_id' => $post->id,
            'title' => 'Filtered Title',
            'content' => '...'
        ]);

        $anotherPost = Post::factory()->create(); // no translation, no category

        $request = Request::create('/posts', 'GET', [
            'category' => $category->id,
            'q' => 'Filtered'
        ]);

        $builder = Post::query();
        $filtered = (new PostFilter($builder, $request))->apply()->get();

        $this->assertTrue($filtered->contains($post));
        $this->assertFalse($filtered->contains($anotherPost));
    }
}