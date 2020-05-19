@extends('layouts.auth')

@section('content')
    <div class="flex h-screen justify-center items-center">
        <div class="column w-full sm:w-1/2 md:w-1/3 mx-auto">
            <h1 class="text-center text-2xl">{{ trans('translations.login') }}</h1>
            <form method="POST" action="{{ route('login') }}" class="panel shadow-normal px-4 py-6">
                @csrf
                <div class="form-group mb-3">
                    <label for="#username">{{ trans('translations.username') }}</label>
                    <input type="text" id="username" class="input @error('username') input--error @enderror" name="username" value="{{ old('username') }}">
                    @error('username')
                        <span class="error-message" role="alert"> 
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="#password">{{ trans('translations.password') }}</label>
                    <input type="password" id="password" class="input @error('password') input--error @enderror" name="password" value="{{ old('password') }}">
                    @error('password')
                        <span class="error-message" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn--full btn--primary">{{ trans('translations.login') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
