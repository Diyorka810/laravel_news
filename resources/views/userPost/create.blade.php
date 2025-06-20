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

    <form action="{{ route('userPost.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="language" class="form-label">{{ __('messages.language') }}</label>
            <select name="language" id="language" class="form-select" >
                @foreach (config('app.locales') as $code => $label)
                    <option value="{{ $code }}" {{ app()->getLocale() === $code ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">{{ __('messages.title') }}</label>
            <input type="text"
                   name="title"
                   id="title"
                   class="form-control @error('title') is-invalid @enderror"
                   placeholder="{{ __('messages.title') }}"
                   >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">{{ __('messages.content') }}</label>
            <textarea name="content"
                      id="content"
                      class="form-control @error('content') is-invalid @enderror"
                      placeholder="{{ __('messages.content') }}"
                      ></textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image_file" class="form-label">{{ __('messages.image') }}</label>
            <input type="file"
                   name="image_file"
                   id="image_file"
                   class="form-control @error('image_file') is-invalid @enderror"
                   accept="image/*"
                   >
            @error('image_file')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <img id="imagePreview" src="" alt="">
            <div id="imgOverlay">
                <img id="overlayImg">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.create_button') }}</button>
    </form>
</div>
@endsection
