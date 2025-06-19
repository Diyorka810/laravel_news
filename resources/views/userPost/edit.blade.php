@extends('layouts.main')

@section('content')
<div>
    <form action="{{ route('userPost.update', $userPost->id) }}?lang={{ request('lang', app()->getLocale()) }}"
          method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- язык перевода --}}
        <div class="mb-3">
            <label for="language" class="form-label">{{ __('messages.language') }} <span class="text-danger">*</span></label>
            <select name="language" id="language" class="form-select" required
                    onchange="location.href='{{ route('userPost.edit', $userPost->id) }}?lang=' + this.value;">
                @foreach (config('app.locales') as $code => $label)
                    <option value="{{ $code }}" {{ request('lang', app()->getLocale()) === $code ? 'selected' : '' }}>
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
                   class="form-control"
                   id="title"
                   value="{{ old('title', $translation?->title) }}"
                   required>
        </div>

        {{-- контент --}}
        <div class="mb-3">
            <label for="content" class="form-label">{{ __('messages.content') }}</label>
            <textarea name="content"
                      class="form-control"
                      id="content"
                      required>{{ old('content', $translation?->content) }}</textarea>
        </div>

        {{-- изображение --}}
        <div class="mb-3">
            <label for="image_file" class="form-label">{{ __('messages.image') }}</label>
            <input type="file"
                   name="image_file"
                   class="form-control"
                   id="image_file"
                   accept="image/*">

            @if ($userPost->image_link)
                <img id="imagePreview" src="{{ asset('storage/' . $userPost->image_link) }}" alt="">
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
