@extends('layouts.main')

@section('content')
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach($images as $image)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $image->name) }}" style="height: 90vh; width:100%" alt="Изображение">
                </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
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
