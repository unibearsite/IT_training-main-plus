@extends('layouts.app')
@include('auth.head')
@include('auth.header')

@section('content')
    <div class="container col-lg-7 col-md-10">
        <div class="contact-title w-75">
            <h2>マイページ</h2>
        </div>

        <div class="mypage-container">
            <div class="business-card" ontouchstart="this.classList.toggle('hover');">
                <div class="flipper">
                    <div class="front">
                        <div class="name">
                            <span class="first">Web</span>
                            <span class="last">Create</span>
                            <span class="title">mypage</span>
                        </div>
                    </div>
                    <div class="back">
                        <div class="container-sm">
                            <figure class="logo-white"></figure>
                        </div>
                        <div class="container-lg">
                            <ul class="social">
                                <li><i class="bi bi-check-square-fill me-2"></i>{{ Auth::user()->name }}</li>
                                <li><i class="bi bi-check-square-fill me-2"></i>{{ Auth::user()->nickname }}</li>
                                <li><i class="fa fa-envelope me-2"></i>{{ Auth::user()->email }}</li>
                                <li>
                                    @foreach ($courses as $course)
                                        @if (Auth::user()->course_id == $course->id)
                                            <i class="bi bi-cpu me-2"></i>{{ $course->course_name }}
                                        @endif
                                    @endforeach
                                </li>
                                <li>
                                    @foreach ($lessons as $lesson)
                                        @if (Auth::user()->lesson_id == $lesson->lesson_id)
                                            <i class="bi bi-code-slash me-2"></i>Lesson{{ $lesson->lesson_id }}
                                            {{ $lesson->title }}
                                        @endif
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    {{-- フッターここに入る --}}
    @include('auth.footer')
