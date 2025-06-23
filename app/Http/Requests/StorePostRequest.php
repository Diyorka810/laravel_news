<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'locale' => ['required', 'string', 'size:2'],
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'image_link' => 'nullable|string',
            'image_file'  => ['required', 'image'],
        ];
    }
}
