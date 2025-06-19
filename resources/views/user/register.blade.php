@extends('layouts.main')
@section('content')
<div >
    <form action="{{ route('user.register.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="user_name" class="form-label">{{ __('messages.nickname') }}</label>
            <input type="text" name="user_name" class="form-control" id="user_name" required>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">{{ __('messages.first_name') }}</label>
            <input type="text" name="first_name" class="form-control" id="first_name" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">{{ __('messages.last_name') }}</label>
            <input type="text" name="last_name" class="form-control" id="last_name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email') }}</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <select name="sex" class="form-control" id="sex">
                <option value="male">{{ __('messages.male') }}</option>
                <option value="female">{{ __('messages.female') }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('messages.password') }}</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.register') }}</button>
    </form>
</div>
@endsection