@extends('layouts.main')

@section('content')
<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('userPost.update', $userPost->id) }}?lang={{ request('lang', app()->getLocale()) }}"
            method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="language" class="form-label">{{ __('messages.language') }} <span class="text-danger">*</span></label>
            <select name="language" id="language" class="form-select"
                    onchange="location.href='{{ route('userPost.edit', $userPost->id) }}?lang=' + this.value;">
                @foreach (config('app.locales') as $code => $label)
                    <option value="{{ $code }}" {{ request('lang', app()->getLocale()) === $code ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">{{ __('messages.category') }}</label>
            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">{{ __('messages.choose_category') }}</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ old('category_id', $userPost->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->parent_id ? '— ' : '' }}{{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">{{ __('messages.title') }}</label>
            <input type="text"
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    id="title"
                    value="{{ old('title', $translation?->title) }}"
                    >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">{{ __('messages.content') }}</label>
            <textarea name="content"
                    class="form-control @error('content') is-invalid @enderror"
                    id="content"
                    >{{ old('content', $translation?->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image_file" class="form-label">{{ __('messages.image') }}</label>
            <input type="file"
                    name="image_file"
                    class="form-control @error('image_file') is-invalid @enderror"
                    id="image_file"
                    accept="image/*">
            @error('image_file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($userPost->image_link)
                <img id="imagePreview" src="" alt="">
            @else
                <img id="imagePreview" src="" alt="">
            @endif

            <div id="imgOverlay">
                <img id="overlayImg">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.edit') }}</button>
    </form>

    @auth
        <form action="{{ route('userPost.destroy', $userPost) }}" method="POST" class="mt-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                {{ __('messages.delete') }}
            </button>
        </form>
    @endauth
</div>
@endsection
