@extends('layouts.layouts')

@section('content')
    @component('components.loginNavbar')
    @endcomponent

    <div class="login">
        <div class="login-box">
            <div class="login-title">
                <h1>Register</h1>
                <p>Forgot password?</p>
            </div>
            <form method="POST" action="/register">
                @csrf
                <div class="login-value-form">
                    <p>名前</p>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <input type="text" name="name" placeholder="name">
                    <p>メールアドレス</p>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <input type="text" name="email" placeholder="email">
                    <p>パスワード</p>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <input type="text" name="password" placeholder="password">
                    <p>パスワード（再入力）</p>
                    <input type="text" name="password_confirmation" placeholder="password">
                    <input type="submit" value="SEND">
                </div>
            </form>
        </div>
    </div>
@endsection
