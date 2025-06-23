@extends('layouts.main')

@section('content')
    <div class="post-banner">
        <img src="{{ asset('storage/' . $post->image_link) }}"
             alt="{{ $post->image_link }}"
             class="post-banner-img">
    </div>

    <div class="mt-3">
        <h2>{{ $post->translation()?->title ?? '—' }}</h2>
        <p>{{ $post->translation()?->content ?? '—' }}</p>
    </div>

    <div class="mt-3">
        <a href="{{ route('post.index') }}" class="btn btn-warning">
            {{ __('messages.back') }}
        </a>
    </div>
@endsection
