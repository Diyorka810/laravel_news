<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'language' => ['required','string','size:2'],
            'title' => 'required|string',
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'content' => 'required|string',
            'image_link' => 'nullable|string',
        ];
    }
}

