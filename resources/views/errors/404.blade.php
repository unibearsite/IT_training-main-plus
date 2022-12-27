@extends('layouts.app')
@include('auth.head')
@include('auth.header')

@section('content')

    <div class="container col-6 mt-5">
        <div class="row">
            <div class="col col-md-offset-3 col-md-12">
                <div class="mt-5 text-center error-container">
                    <p class="display-5">お探しのページは見つかりませんでした。</p>
                    <a href="{{ route('home') }}" class="mt-5 btn home-btn">
                        ホームへ戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- フッターここに入る --}}
@include('auth.footer')
