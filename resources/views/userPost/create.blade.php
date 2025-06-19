@extends('layouts.main')

@section('content')
<div>
    <form action="{{ route('userPost.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- язык --}}
        <div class="mb-3">
            <label for="language" class="form-label">{{ __('messages.language') }}</label>
            <select name="language" id="language" class="form-select" required>
                @foreach (config('app.locales') as $code => $label)
                    <option value="{{ $code }}" {{ app()->getLocale() === $code ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- заголовок --}}
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('messages.title') }}</label>
            <input type="text"
                   name="title"
                   id="title"
                   class="form-control"
                   placeholder="{{ __('messages.title') }}"
                   required>
        </div>

        {{-- контент --}}
        <div class="mb-3">
            <label for="content" class="form-label">{{ __('messages.content') }}</label>
            <textarea name="content"
                      id="content"
                      class="form-control"
                      placeholder="{{ __('messages.content') }}"
                      required></textarea>
        </div>

        {{-- изображение --}}
        <div class="mb-3">
            <label for="image_file" class="form-label">{{ __('messages.image') }}</label>
            <input type="file"
                   name="image_file"
                   id="image_file"
                   class="form-control"
                   accept="image/*"
                   required>

            {{-- превью и оверлей --}}
            <img id="imagePreview" src="{{ asset('images/first_post.jpeg') }}" alt="">
            <div id="imgOverlay">
                <img id="overlayImg">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.create_button') }}</button>
    </form>
</div>
@endsection
