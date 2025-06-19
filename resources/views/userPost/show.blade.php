@extends('layouts.main')

@section('content')
    <div class="post-banner">
        <img src="{{ asset('storage/' . $userPost->image_link) }}"
             alt="{{ $userPost->image_link }}"
             class="post-banner-img">
    </div>

    <div class="mt-3">
        <h2>{{ $userPost->translation()?->title ?? '—' }}</h2>
        <p>{{ $userPost->translation()?->content ?? '—' }}</p>
    </div>

    <div class="mt-3">
        <a href="{{ route('userPost.index') }}" class="btn btn-warning">
            {{ __('messages.back') }}
        </a>
    </div>
@endsection
