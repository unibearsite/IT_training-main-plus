@extends('layouts.app')
@include('auth.head')
@include('auth.header')

@section('content')
    <div class="container col-lg-6 col-md-10">
        <div class="contact-title w-75">
            <h2>お問い合わせ</h2>
        </div>
        {{-- タイトルフォーム --}}
        <div class="w-75 h-100 mb-4 form-group form-heading">
            <label for="title">タイトル<span class="ms-2 text-danger">*必須</span></label>
            <span class="text-danger help-block">{{ $errors->first('title') }}</span>
            <input class="@if (!empty($errors->first('title'))) has-error @endif form-control rounded mt-3 ms-auto me-auto py-3"
                type="text" name="title" placeholder="タイトル" required>
        </div>
        @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('title') }}
            </span>
        @endif

        {{-- ユーザー名フォーム --}}
        <div class="w-75 h-100 mt-md-5 mt-sm-2 mb-4 mb-sm-2 form-group form-heading">
            <label for="user_name">名前（フルネーム）<span class="ms-2 text-danger">*必須</span></label>
            <span class="text-danger help-block">{{ $errors->first('user_name') }}</span>
            <input class="@if (!empty($errors->first('user_name'))) has-error @endif form-control rounded mt-3 ms-auto me-auto py-3"
                type="text" name="user_name" placeholder="名前" maxlength="20" required>
        </div>
        @if ($errors->has('user_name'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('user_name') }}
            </span>
        @endif


        {{-- メッセージフォーム --}}
        <div class="w-75 h-100 mt-md-5 mt-sm-2 mb-4 mb-sm-2 form-group form-heading">
            <label for="message">お問い合わせ内容（ご質問、不具合等）<span class="ms-1 text-danger">*必須</span></label>
            <span class="text-danger help-block">{{ $errors->first('message') }}</span>
            <textarea class="@if (!empty($errors->first('message'))) has-error @endif form-control h-100  ms-auto me-auto mt-3 ml-2 py-3 px-2 rounded message_area"
                name="message" placeholder="お問い合わせ内容を入力してください" maxlength="1000" required>
        </textarea>
        </div>
        @if ($errors->has('message'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('message') }}
            </span>
        @endif

        <div class="text-center confirm-button">
            <button type="button" class="btn bg-key btn-lg form-btn text-white contactForm-btn" data-bs-toggle="modal"
                data-bs-target="#exampleModalCenter">
                確認画面へ
            </button>
            @if (Session::has('success'))
                <div class="mt-4 ml-2 px-4 session badge-success d-inline-block">
                    <p class="ml-2 p-3 bg-light text-center">{{ Session::get('success') }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade rounded" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalCenterTitle" class="text-center display-6">この内容で送信してもよろしいですか？</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('send.contact') }}" method='POST' class="mt-5 text-center" novalidate>
                        @csrf
                        <div class="form-group row modal-container">
                            <p class="col-form-label">【タイトル】</p>
                            <div class="mt-4">
                                <p class="modal-title mb-3"></p>
                                <input class="modal-title" type="hidden" name="title" value="">
                                <span class="invalid-feedback">項目を入力してください.</span>
                            </div>
                        </div>

                        <div class="form-group row modal-container">
                            <p class="col-form-label">【名前（フルネーム）】</p>
                            <div class="mt-4">
                                <p class="modal-name mb-3"></p>
                                <input class="modal-name" type="hidden" name="user_name" value="">
                                <span class="invalid-feedback">項目を入力してください.</span>
                            </div>
                        </div>

                        <div class="form-group row modal-container">
                            <p class="col-form-label">【お問い合わせ内容（ご質問、不具合等）】</p>
                            <div class="mt-4">
                                <p class="modal-message mb-5"></p>
                                <input class="modal-message" type="hidden" name="message" value="">
                                <span class="invalid-feedback">項目を入力してください.</span>
                            </div>

                        </div>

                        @php
                            $now = date('Y-m-d H:i:s');
                        @endphp
                        {{-- 送信日時 --}}
                        <input type="hidden" name="created_at" value="{{ $now }}">
                        {{-- 送信ボタン --}}
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary btn-lg my-5 me-4 py-2 px-4"
                                data-bs-dismiss="modal">閉じる</button>
                            <button type="submit" class="btn bg-key btn-lg my-5 py-2 px-4 text-white">送信</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- フッターここに入る --}}
@include('auth.footer')
