@extends('layouts.main')
@section('content')
    <div >
        <form action="{{ route('user.login.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="user_name" class="form-label">{{ __('messages.nickname') }}</label>
                <input type="text" name="user_name" class="form-control" id="user_name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('messages.password') }}</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('messages.login') }}</button>
        </form>
    </div>
@endsection