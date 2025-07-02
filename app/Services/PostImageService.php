<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostImageService
{
    private string $disk = 'public';
    private string $folder = 'posts';


    public function store(UploadedFile $file): string
    {
        $filename = now()->format('Ymd_His') . '_' . Str::random(6) . '.' . $file->extension();
        
        return $file->storeAs($this->folder, $filename, $this->disk);
    }

    public function replace(UploadedFile $file, ?string $oldPath = null): string
    {
        if ($oldPath) {
            Storage::disk($this->disk)->delete($oldPath);
        }

        return $this->store($file);
    }

    public function delete(?string $path): void
    {
        if ($path) {
            Storage::disk($this->disk)->delete($path);
        }
    }
}
