@extends('layouts.main')

@section('content')
<div class="row g-3 mt-3">
    @foreach ($userPosts as $userPost)
        <div class="col-12 col-sm-6 col-md-4">
            <div class="post border p-2 h-100 d-flex flex-column justify-content-between" style="word-break: break-word; overflow-wrap: break-word; position: relative;">
                <a href="{{ route('userPost.show', $userPost) }}" class="text-decoration-none text-dark d-block">
                    <img src="{{ asset('storage/' . $userPost->image_link) }}" class="card-img" alt="{{ $userPost->image_link }}" style="height: 250px; object-fit: cover;">
                    <h2 class="h5">{{ \Illuminate\Support\Str::limit($userPost->title, 50) }}</h2>
                    <p>{{ \Illuminate\Support\Str::limit($userPost->content, 140) }}</p>
                </a>

                @if (auth()->check() && (auth()->id() === $userPost->user_id || auth()->user()->is_admin))
                    <a href="{{ route('userPost.edit', $userPost) }}" class="btn btn-sm btn-outline-secondary" style="width: 25%; position: absolute; bottom: 8px; right: 8px;">
                       {{ __('messages.edit') }}
                    </a>
                @else
                    <div style="height: 32px;"></div>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
