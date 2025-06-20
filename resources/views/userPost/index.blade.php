@extends('layouts.main')

@section('content')
<div class="row mt-3">
    <div class="col-md-4 col-sm-6">
        <form method="GET" action="{{ route('userPost.index') }}">
            <select name="category"
                    class="form-select"
                    onchange="this.form.submit()">
                <option value="">{{ __('messages.all_categories') }}</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}"
                            {{ $categoryId == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="row g-3 mt-3">
    @foreach ($userPosts as $userPost)
        <div class="col-12 col-sm-6 col-md-4">
            <div class="post-card border p-2 h-100 d-flex flex-column justify-content-between">
                <a href="{{ route('userPost.show', $userPost) }}"
                   class="text-decoration-none text-dark d-block">

                    <img src="{{ asset('storage/' . $userPost->image_link) }}"
                         class="card-img-top post-thumbnail"
                         alt="{{ $userPost->image_link }}">

                    <h2 class="h5">
                        {{ \Illuminate\Support\Str::limit($userPost->translation()?->title ?? '—', 50) }}
                    </h2>
                    <p>
                        {{ \Illuminate\Support\Str::limit($userPost->translation()?->content ?? '—', 140) }}
                    </p>
                </a>

                @if (auth()->check() && (auth()->id() === $userPost->user_id || auth()->user()->is_admin))
                    <a href="{{ route('userPost.edit', $userPost) }}"
                       class="btn btn-sm btn-outline-secondary edit-btn">
                        {{ __('messages.edit') }}
                    </a>
                @else
                    <div class="edit-btn-placeholder"></div>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
