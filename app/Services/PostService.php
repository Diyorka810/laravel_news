<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\PostImageService;

class PostService
{
    public function __construct(private PostImageService $images) {}

    public function createPost(array $data, array $imageFiles = [], ?string $mainImage = null): void
    {
        DB::transaction(function () use ($data, $imageFiles, $mainImage) {
            $post = Post::create([
                'user_id' => Auth::id(),
            ]);

            $newImageIds = $this->storeImages($post, $imageFiles);
            $this->setCoverImage($post, $mainImage, $newImageIds);

            $this->syncCategories($post, $data['category_id'] ?? null);

            $this->createOrUpdateTranslation($post, $data);
        });
    }

    public function updatePost(Post $post, array $data, array $imageFiles = [], array $keepImageIds = [], ?string $mainImage = null): void
    {
        DB::transaction(function () use ($post, $data, $imageFiles, $keepImageIds, $mainImage) {
            $post->images()->whereNotIn('id', $keepImageIds)->delete();

            $newImageIds = $this->storeImages($post, $imageFiles);

            $this->setCoverImage($post, $mainImage, $newImageIds);
            $this->syncCategories($post, $data['category_id'] ?? null);

            $this->createOrUpdateTranslation($post, $data);
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

    private function storeImages(Post $post, array $imageFiles): array
    {
        $imageIds = [];

        foreach ($imageFiles as $file) {
            $path = $this->images->store($file);
            $image = $post->images()->create([
                'name' => $path,
                'is_cover' => false,
            ]);
            $imageIds[] = $image->id;
        }

        return $imageIds;
    }

    private function setCoverImage(Post $post, ?string $mainImage, array $newImageIds): void
    {
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
        } elseif (!empty($newImageIds)) {
            $post->images()->where('id', $newImageIds[0])->update(['is_cover' => true]);
        }
    }

    private function syncCategories(Post $post, ?int $categoryId): void
    {
        if ($categoryId) {
            $post->categories()->sync($this->collectAncestorIds($categoryId));
        }
    }

    private function createOrUpdateTranslation(Post $post, array $data): void
    {
        if (!isset($data['locale'], $data['title'], $data['content'])) {
            throw new \InvalidArgumentException('Missing translation fields');
        }

        $post->translations()->updateOrCreate(
            ['locale' => $data['locale']],
            [
                'title' => $data['title'],
                'content' => $data['content'],
            ]
        );
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
