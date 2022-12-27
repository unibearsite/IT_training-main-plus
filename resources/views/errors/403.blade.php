@extends('layouts.app')
@include('auth.head')
@include('auth.header')

@section('content')

<div class="container col-6">
    <div class="row">
        <div class="col col-md-offset-3 col-md-12">
            <div class="mt-5 text-center error-container">
                <p class="display-5">お探しのページにアクセスする権限がありません。</p>
                <a href="{{ route('home') }}" class="mt-5 btn btn-secondary">
                    ホームへ戻る
                </a>
            </div>
        </div>
    </div>
    </div>
@endsection


{{-- フッターここに入る --}}
@include('auth.footer')
