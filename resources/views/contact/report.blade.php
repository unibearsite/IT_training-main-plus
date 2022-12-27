@extends('layouts.app')
@include('auth.head')
@include('auth.header')

@section('content')
    <div class="container col-lg-7 col-md-10">
        <div class="contact-title">
            <h2>ウィークリー</h2>
            <div class="notes">
                <p class="center mt-2 mb-3">------ 注意事項 -----</p>
                <p><i class="bi bi-check me-1"></i>ウィークリー（週次報告）と勉強会参加アンケートは<span class="bold">毎週金曜日〜日曜日まで</span>に提出してください！</p>
                <p><i class="bi bi-check me-1"></i>講師から受講生のみなさまにフィードバックを行います！</p>
            </div>
        </div>

        <div class="contact-contents">
            <div class="report-group">
                <a target="_brank"
                    href="https://docs.google.com/forms/d/e/1FAIpQLScUbw41cac10_YZdoZAryLVC3ztD6A9waUd_jq4hIl7Awu4Tw/closedform"
                    class="btn bgcentery"><span>【ウィークリー】<br>提出はこちらから！</span></a>
            </div>

            <div class="report-group">
                <a target="_brank"
                    href="https://docs.google.com/forms/d/e/1FAIpQLScRNXZ_mqdOqSpof3phaEKj6MIpiaGY98Ckfnjcn9RqThqDYQ/viewform"
                    class="btn bgcentery"><span>【ウィークリー】<br>忘れた方はこちらから！</span></a>
            </div>

            <div class="report-group">
                <a target="_brank"
                    href="https://docs.google.com/forms/d/e/1FAIpQLSf0nxe82fwd14-MKBlHeS1ZoJAFCpSNZKxVtR64UP6deKxdKQ/viewform"
                    class="btn bgcentery"><span>【勉強会参加アンケート】<br>こちらから！</span></a>
            </div>
        </div>

    </div>
@endsection


{{-- フッターここに入る --}}
@include('auth.footer')
