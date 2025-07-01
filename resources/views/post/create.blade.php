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

    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="locale" class="form-label">{{ __('messages.locale') }}</label>
            <select name="locale" id="locale" class="form-select" >
                @foreach (config('app.locales') as $code => $label)
                    <option value="{{ $code }}" {{ app()->getLocale() === $code ? 'selected' : '' }}>
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
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->parent_id ? '— ' : '' }}{{ $cat->translation()?->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">{{ __('messages.title') }}</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="{{ __('messages.title') }}" value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">{{ __('messages.content') }}</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" placeholder="{{ __('messages.content') }}" value="{{ old('content') }}"></textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input
                type="file"
                name="image_file[]"
                id="image_file"
                class="form-control @error('image_file') is-invalid @enderror"
                accept="image/*"
                multiple
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Предпросмотр изображений</label>
            <div id="all-images" class="d-flex gap-2 flex-wrap"></div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.create_button') }}</button>
    </form>
</div>
@endsection
