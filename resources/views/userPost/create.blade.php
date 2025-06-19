@extends('layouts.main')
@section('content')
    <div >
        <form action="{{ route('userPost.store') }}" method="post" enctype="multipart/form-data">
            @csrf
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

            <div class="mb-3">
                <label for="title" class="form-label">{{ __('messages.title') }}</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('messages.title') }}" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">{{ __('messages.content') }}</label>
                <textarea name="content" class="form-control" id="content" placeholder="{{ __('messages.content') }}" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image_file" class="form-label">{{ __('messages.image') }}</label>
                <input type="file" name="image_file" class="form-control" id="image_file" accept="image/*" required>
                <img id="imagePreview" src="{{ asset('images/first_post.jpeg') }}" alt="" style="max-width: 200px; margin-top: 10px; display: none;">
                <div id="imgOverlay" style="display:none;position:fixed;inset:0;z-index:1050;background:rgba(0,0,0,.8);justify-content:center;align-items:center;">
                    <img id="overlayImg" style="max-width:90%;max-height:90%;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('messages.create_button') }}</button>
          </form>
    </div>
@endsection