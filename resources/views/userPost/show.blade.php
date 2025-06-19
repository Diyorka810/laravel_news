@extends('layouts.main')

@section('content')
    <div class="position-relative" style="height: 80vh; overflow: hidden;">
        <img src="{{ asset('storage/' . $userPost->image_link) }}" alt="{{ $userPost->image_link }}" class="w-100 h-100" style="object-fit: cover;">
    </div>

    <div class="mt-3">
        <h2>{{ $userPost->title }}</h2>
        <p>{{ $userPost->content }}</p>
    </div>

    <div class="mt-3">
        <a href="{{ route('userPost.index') }}" class="btn btn-warning">{{ __('messages.back') }}</a>
    </div>
@endsection
