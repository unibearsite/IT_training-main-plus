@extends('layouts.app')
@include('auth.head')
@section('content')
    <div class="login-wrapper">
        <div class="login-header-container">
            <a href="{{ route('show.contact') }}">お問い合わせ</a>
            <a href="https://libero-net.com/">運営会社</a>
        </div>

        <div class="login-main-wrapper">
            <div class="login-container">

                <div class="login-left-container">
                   
                    {{-- ロゴ --}}
                    <div class="logo-container">
                        <a href="{{ url('/') }}">
                            <img class="app-logo" src="{{ asset('storage/images/logo_webCreate.png') }}"
                                alt="WebCreate_Logo">
                        </a>
                    </div>
                   
                    {{-- キャッチコピー --}}
                   <div class="catch-copy-container">
                    <h1>ようこそ！うぇぶくりへ</h1>
                    <h2>生まれ変われ、<br>自分史上 <span>最強の自分 </span>に！</h2>
                    <div class="soap_wrap">
                        <div class="soap soap1">
                            <img class="soap-img" src="{{ asset('storage/images/marugori.png') }}" alt="ゴリラ">
                        </div>
                    </div>
                    <div class="soap_wrap">
                        <div class="soap soap2 delay-time04">
                        </div>
                    </div>
                    <div class="soap_wrap">
                        <div class="soap soap3 delay-time04"></div>
                    </div>
                    <div class="soap_wrap">
                        <div class="soap soap4 delay-time06"></div>
                    </div>
                </div>
            </div>
                <div class="login-right-container">
                    <div class="form-wrapper">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-item">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" class="@error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="メールアドレス" required
                                    autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-item">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="@error('password') is-invalid @enderror"
                                    name="password" placeholder="パスワード" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- <div class="row">
                                <div class="check-container">
                                    <div class="form-check login-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="button-panel">
                                <input type="submit" class="button" title="Sign In" value="ログイン">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="login-footer-container">
            <div class="copy-light">
                <small class="copy">Copyright © Web Create All Rights Reserved.​</small>
            </div>
        </footer>
    </div>
@endsection
