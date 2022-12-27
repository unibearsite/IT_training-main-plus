@extends('layouts.app')
@include('auth.head')
@include('auth.header')

@section('content')
    <div class="container col-7">
        <form action="{{ url('slack') }}" method='POST'>
            @csrf
            <div class="form-group">
                <p class="mb-2">名前</p>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control mb-3">

                <p class="mb-2">メッセージ</p>
                <input type="text" name="message" value="{{ old('message') }}" class="form-control">

                <p><input type="submit" value="送信" class="btn btn-light mt-4"></p>
            </div>
        </form>

        @if (Session::has('success'))
            <div class="ml-2 mt-4 px-4 session col-4 d-inline-block">
                <p class="ml-2 p-3 bg-key text-center">{{ Session::get('success') }}</p>
            </div>
        @endif
    </div>


@endsection


{{-- フッターここに入る --}}
@include('auth.footer')