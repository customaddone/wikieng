@extends('layouts.layouts')

@section('content')
    @component('components.loginNavbar')
    @endcomponent

    <div class="login">
        <div class="login-box">
            <div class="login-title">
                <h1>Sign in</h1>
                <p>Forgot password?</p>
            </div>
            <form method="POST" action="/login">
                {{ csrf_field() }}
                <div class="login-value-form">
                    <p>メールアドレス</p>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <input type="text" id="email" name="email" placeholder="email" value="{{ old('email') }}">
                    <p>パスワード</p>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <input type="text" id="password" name="password" placeholder="password" value="{{ old('password') }}">
                    <input type="submit" value="SEND">
                </div>
            </form>
        </div>
    </div>
@endsection
