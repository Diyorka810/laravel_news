@php use Illuminate\Support\Str; @endphp

@extends('layouts.main')

@section('content')
<div class="row mt-3">
    <div class="col-md-4 col-sm-6">
        <form method="GET" action="{{ route('post.index') }}">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">{{ __('messages.choose_category') }}</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->parent_id ? '— ' : '' }}{{ $cat->translation()?->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="row g-3 mt-3">
    @foreach ($posts as $post)
        <div class="col-12 col-sm-6 col-md-4">
            <div class="post-card border p-2 h-100 d-flex flex-column justify-content-between">
                <a href="{{ route('post.show', $post) }}" class="text-decoration-none text-dark d-block">
                    <img src="{{ asset('storage/' . ($post->coverImage?->name ?? 'placeholders/no-image.png')) }}"
                        class="card-img-top post-thumbnail"
                        alt="{{ $post->coverImage?->name ?? 'Нет изображения' }}">
                    <h2 class="h5">
                        {{ Str::limit($post->translation()?->title ?? '—', 50) }}
                    </h2>
                    <p>
                        {{ Str::limit($post->translation()?->content ?? '—', 140) }}
                    </p>
                </a>

                <div class="edit-btn-placeholder">
                    @if (auth()->check() && (auth()->id() === $post->user_id || auth()->user()->is_admin))
                        <a href="{{ route('post.edit', $post) }}" class="btn btn-sm btn-outline-secondary edit-btn">
                            {{ __('messages.edit') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="pagination-container mt-4 d-flex justify-content-center">
    {{ $posts->links('pagination::bootstrap-5') }}
</div>
@endsection
