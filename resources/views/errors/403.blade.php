@extends('layouts.main')

@section('content')
    <div class="text-center mt-5">
        <h1 class="display-4">403 - {{ __('messages.403_title') }}</h1>
        <p class="lead">{{ __('messages.403_content') }}</p>
    </div>
@endsection