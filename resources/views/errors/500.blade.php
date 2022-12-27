@extends('layouts.app')
@include('auth.head')
@include('auth.header')

@section('content')

    <div class="container col-6 mt-5">
        <div class="row">
            <div class="col col-md-offset-3 col-md-12">
                <div class="mt-5 text-center error-container">
                    <p class="display-6">サーバーエラーまたはログインセッションタイムアウトです。</p>
                    <p class="display-6">ログイン画面へお戻りください。</p>
                    <a href="{{ route('home') }}" class="mt-5 btn home-btn">
                        ログイン画面へ戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
