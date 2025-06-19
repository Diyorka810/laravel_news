@extends('layouts.main')
@section('content')
    <div>
        <form action="{{ route('userPost.update', $userPost->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="mb-3">
                    <label for="language" class="form-label">{{ __('messages.language') }} <span class="text-danger">*</span></label>
                    <select name="language" id="language" class="form-select" required onchange="location.href='{{ route('userPost.edit', $userPost->id) }}?lang=' + this.value;">
                        @foreach (config('app.locales') as $code => $label)
                            <option value="{{ $code }}" {{ request('lang', app()->getLocale()) === $code ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('messages.title') }}</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $userPost->translation()?->title ?? '—') }}" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">{{ __('messages.content') }}</label>
                    <textarea name="content" class="form-control" id="content" required>{{ old('content', $userPost->translation()?->content ?? '—') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="image_file" class="form-label">{{ __('messages.image') }}</label>
                    <input type="file" name="image_file" class="form-control" id="image_file" accept="image/*">
                    <img id="imagePreview" src="{{ $userPost->image_link ? asset('storage/' . $userPost->image_link) : '' }}" alt="" style="max-width: 200px; margin-top: 10px;">
                    <div id="imgOverlay" style="display:none;position:fixed;inset:0;z-index:1050;background:rgba(0,0,0,.8);justify-content:center;align-items:center;">
                        <img id="overlayImg" style="max-width:90%;max-height:90%;">
                    </div>
                </div>
            <button type="submit" class="btn btn-primary">{{ __('messages.edit') }}</button>
        </form>
        @if (auth()->check())
            <form action="{{ route('userPost.destroy', $userPost) }}" method="POST">
                @csrf
                @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        {{ __('messages.delete') }}
                    </button>
            </form>
        @endif
    </div>
@endsection