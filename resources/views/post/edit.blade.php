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

    <form action="{{ route('post.update', $post->id) }}?lang={{ request('lang', app()->getLocale()) }}"
            method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="locale" class="form-label">{{ __('messages.locale') }} <span class="text-danger">*</span></label>
            <select name="locale" id="locale" class="form-select"
                    onchange="location.href='{{ route('post.edit', $post->id) }}?lang=' + this.value;">
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
                        {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
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

            @if ($post->image_link)
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
        <form action="{{ route('post.destroy', $post) }}" method="POST" class="mt-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                {{ __('messages.delete') }}
            </button>
        </form>
    @endauth

    <hr class="my-4">

    <h4>Добавить изображения</h4>

    <form action="{{ route('post.image.store', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="images" class="form-label">Новые изображения</label>
            <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple>
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Выбери обложку</label>
            <div id="imagePreviewContainer" class="row"></div>
        </div>

        <button type="submit" class="btn btn-success">Загрузить</button>
    </form>

</div>
<script>
    document.getElementById('images').addEventListener('change', function (e) {
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = ''; // очистка

        Array.from(e.target.files).forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function (event) {
                const col = document.createElement('div');
                col.classList.add('col-3', 'mb-3');

                const img = document.createElement('img');
                img.src = event.target.result;
                img.classList.add('img-thumbnail');
                img.style.width = '100%';

                const radio = document.createElement('input');
                radio.type = 'radio';
                radio.name = 'cover_index';
                radio.value = index;
                radio.classList.add('form-check-input', 'mt-2');

                const label = document.createElement('label');
                label.textContent = 'Обложка';
                label.classList.add('form-check-label', 'ms-1');

                col.appendChild(img);
                col.appendChild(radio);
                col.appendChild(label);

                container.appendChild(col);
            };

            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
