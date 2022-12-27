@extends('layouts.app')
@include('auth.head')
@include('auth.header')

@section('content')
    <div class="container col-lg-6 col-md-10">
        <div class="contact-title w-75">
            <h2>メンタリング予約</h2>
        </div>
        @php
            $now = date('Y-m-d H:i:s');
        @endphp


        {{-- ユーザー名フォーム --}}
        <div class="w-75 h-100 mt-md-5 mt-sm-2 mb-4 mb-sm-2 form-group form-heading">
            <label for="user_name">名前（フルネーム）<span class="ms-2 text-danger">*必須</span></label>
            <span class="text-danger help-block">{{ $errors->first('user_name') }}</span>
            <input class="@if (!empty($errors->first('user_name'))) has-error @endif form-control rounded mt-3 ms-auto me-auto py-3"
                type="text" name="user_name" placeholder="名前" maxlength="20" required>
        </div>

        {{-- 目的 --}}
        <div class="w-75 h-100 mt-5 mb-4 form-group form-heading">
            <label for="perpose">目的<span class="ms-2 text-danger">*必須</span></label>
            <span class="text-danger help-block">{{ $errors->first('perpose') }}</span>
            <select name="perpose"
                class="@if (!empty($errors->first('perpose'))) has-error @endif form-select mt-3 ms-auto me-auto py-3"
                id="">
                <option value="" selected>目的を選択してください</option>
                <option value="面談">面談</option>
                <option value="個別勉強会">個別勉強会</option>
                <option value="グループ勉強会">グループ勉強会</option>
            </select>
        </div>

        {{-- 第1希望日時 --}}
        <div class="w-75 h-100 form-group mt-md-5 mt-sm-2 mb-4 mb-sm-2 form-heading" id="datetimepicker"
            data-target-input="nearest">
            <label for="datetimepicker">希望日（第1希望）<span class="ms-2 text-danger">*必須</span></label>
            <span class="text-danger help-block">{{ $errors->first('date1') }}</span>
            <div class="preferred-group">
                <input class="@if (!empty($errors->first('date1'))) has-error @endif form-control rounded" type="text"
                    name="date1" data-input data-target="#datetimepicker" style='background:white' />
                <span class="form-control input-group-text" data-toggle>
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
        </div>

        {{-- 第2希望日時 --}}
        <div class="w-75 h-100 form-group mt-md-5 mt-sm-2 mb-4 mb-sm-2 form-heading" id="datetimepicker"
            data-target-input="nearest">
            <label for="datetimepicker">希望日（第2希望）<span class="ms-2 text-danger">*必須</span></label>
            <span class="text-danger help-block">{{ $errors->first('date2') }}</span>
            <div class="preferred-group">
                <input class="@if (!empty($errors->first('date2'))) has-error @endif form-control rounded" type="text"
                    name="date2" data-input data-target="#datetimepicker" style='background:white' />
                <span class="form-control input-group-text" data-toggle>
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
        </div>
        {{-- 第3希望日時 --}}
        <div class="w-75 h-100 form-group mt-md-5 mt-sm-2 mb-4 mb-sm-2 form-heading" id="datetimepicker"
            data-target-input="nearest">
            <label for="datetimepicker">希望日（第3希望）<span class="ms-2 text-danger">*必須</span></label>
            <span class="text-danger help-block">{{ $errors->first('date3') }}</span>
            <div class="preferred-group">
                <input class="@if (!empty($errors->first('date3'))) has-error @endif form-control rounded" type="text"
                    name="date3" data-input data-target="#datetimepicker" style='background:white' />
                <span class="form-control input-group-text" data-toggle>
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
        </div>

        {{-- メッセージフォーム --}}
        <div class="w-75 h-100 mt-md-5 mt-sm-2 mb-4 mb-sm-2 form-group form-heading">
            <label for="message">備考欄</label>
            <textarea
                class="form-control h-100  ms-auto me-auto mt-3 ml-2 py-3 px-2 rounded message_area"
                name="message" placeholder="例：終日OK など" maxlength="1000" required></textarea>
        </div>
   


        <div class="text-center">
            <button type="button" class="ml-2 mt-4 py-3 px-4 btn btn-lg bg-key text-white form-btn meetingForm-btn"
                data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                確認画面へ
            </button>
            @if (Session::has('success'))
                <div class="ml-2 px-4 session badge-success d-inline-block">
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
                    <form action="{{ route('send.meeting') }}" method='POST' class="mt-5 text-center">
                        @csrf
                        <div class="form-group row modal-container">
                            <p class="col-form-label">【お名前】</p>
                            <div class="mt-4">
                                <p class="modal-name mb-3"></p>
                                <input class="modal-name" type="hidden" name="user_name" value="">
                            </div>
                        </div>

                        <div class="form-group row modal-container">
                            <p class="col-form-label">【目的】</p>
                            <div class="mt-4">
                                <p class="modal-perpose mb-3"></p>
                                <input class="modal-perpose" type="hidden" name="perpose" value="">
                            </div>
                        </div>

                        <div class="form-group row modal-container">
                            <p class="col-form-label">【第１希望日時】</p>
                            <div class="mt-4">
                                <p class="modal-date1 mb-3"></p>
                                <input class="modal-date1" type="hidden" name="date1" value="">
                            </div>
                        </div>

                        <div class="form-group row modal-container">
                            <p class="col-form-label">【第２希望日時】</p>
                            <div class="mt-4">
                                <p class="modal-date2 mb-3"></p>
                                <input class="modal-date2" type="hidden" name="date2" value="">
                            </div>
                        </div>

                        <div class="form-group row modal-container">
                            <p class="col-form-label">【第３希望日時】</p>
                            <div class="mt-4">
                                <p class="modal-date3 mb-5"></p>
                                <input class="modal-date3" type="hidden" name="date3" value="">
                            </div>
                        </div>
                        <div class="form-group row modal-container">
                            <p class="col-form-label">【備考】</p>
                            <div class="mt-4">
                                <p class="modal-message mb-5"></p>
                                <input class="modal-message" type="hidden" name="message" value="">
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
