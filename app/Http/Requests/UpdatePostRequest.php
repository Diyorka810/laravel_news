<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'locale' => ['required','string','size:2'],
            'title' => 'required|string',
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'content' => 'required|string',
            'image_link' => 'nullable|string',
            'main_image' => ['nullable', 'string'],
        ];
    }
}

