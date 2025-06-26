@extends('layouts.main')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div >
        <form action="{{ route('user.login.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="user_name" class="form-label">{{ __('messages.nickname') }}</label>
                <input type="text" name="user_name" class="form-control" id="user_name" value="{{ old('user_name') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('messages.password') }}</label>
                <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('messages.login') }}</button>
        </form>
    </div>
@endsection