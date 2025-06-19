<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'language' => ['required', 'string', 'size:2'],
            'title' => 'required|string',
            'content' => 'required|string',
            'image_link' => 'nullable|string',
            'image_file'  => ['required', 'image'],
        ];
    }
}
