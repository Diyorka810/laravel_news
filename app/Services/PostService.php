<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\PostImageService;
use App\Models\Category;

class PostService
{
    public function __construct(private PostImageService $images) {}

    public function createPost(array $data, array $imageFiles = [], ?string $mainImage = null): void
    {
        DB::transaction(function () use ($data, $imageFiles, $mainImage) {
            $post = Post::create([
                'user_id' => Auth::id(),
                'is_published' => true,
            ]);

            $newImageIds = [];

            foreach ($imageFiles as $file) {
                $path = $this->images->store($file);
                $image = $post->images()->create([
                    'name' => $path,
                    'is_cover' => false,
                ]);
                $newImageIds[] = $image->id;
            }

            if ($mainImage) {
                if (str_starts_with($mainImage, 'new_')) {
                    $index = (int) str_replace('new_', '', $mainImage);
                    if (isset($newImageIds[$index])) {
                        $post->images()->where('id', $newImageIds[$index])->update(['is_cover' => true]);
                    }
                }
            } else {
                if (!empty($newImageIds)) {
                    $post->images()->where('id', $newImageIds[0])->update(['is_cover' => true]);
                }
            }

            if (!empty($data['category_id'])) {
                $post->categories()->sync(
                    $this->collectAncestorIds($data['category_id'])
                );
            }

            $post->translations()->create([
                'locale' => $data['locale'],
                'title' => $data['title'],
                'content' => $data['content'],
            ]);
        });
    }

    public function updatePost(Post $post, array $data, array $imageFiles = [], array $keepImageIds = [], ?string $mainImage = null): void
    {
        DB::transaction(function () use ($post, $data, $imageFiles, $keepImageIds, $mainImage) {
            $post->images()->whereNotIn('id', $keepImageIds)->delete();

            $newImageIds = [];
            foreach ($imageFiles as $file) {
                $path = $this->images->store($file);
                $image = $post->images()->create([
                    'name' => $path,
                    'is_cover' => false,
                ]);
                $newImageIds[] = $image->id;
            }

            $post->images()->update(['is_cover' => false]);

            if ($mainImage) {
                if (str_starts_with($mainImage, 'existing_')) {
                    $id = (int) str_replace('existing_', '', $mainImage);
                    $post->images()->where('id', $id)->update(['is_cover' => true]);
                } elseif (str_starts_with($mainImage, 'new_')) {
                    $index = (int) str_replace('new_', '', $mainImage);
                    if (isset($newImageIds[$index])) {
                        $post->images()->where('id', $newImageIds[$index])->update(['is_cover' => true]);
                    }
                }
            }

            if (!empty($data['category_id'])) {
                $post->categories()->sync(
                    $this->collectAncestorIds($data['category_id'])
                );
            }

            $post->translations()->updateOrCreate(
                ['locale' => $data['locale']],
                [
                    'title' => $data['title'],
                    'content' => $data['content'],
                ]
            );
        });
    }

    public function storeImages(Post $post, array $files, ?int $coverIndex): void
    {
        DB::transaction(function () use ($post, $files, $coverIndex) {
            foreach ($files as $i => $file) {
                $path = $this->images->store($file);

                $post->images()->create([
                    'name' => $path,
                    'is_cover' => ($i === $coverIndex),
                ]);
            }
        });
    }

    public function deletePost(Post $post): void
    {
        DB::transaction(function () use ($post) {
            foreach ($post->images as $image) {
                if ($image->name && Storage::disk('public')->exists($image->name)) {
                    Storage::disk('public')->delete($image->name);
                }
            }

            $post->delete();
        });
    }

    private function collectAncestorIds(int $categoryId): array
    {
        $ids = [];
        $current = Category::find($categoryId);

        while ($current) {
            $ids[] = $current->id;
            $current = $current->parent;
        }

        return $ids;
    }
}
