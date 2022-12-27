@extends('layouts.addSide')

@include('auth.head')
@include('auth.header')

@section('content')
    <div class="container">

        <div id="posts_list" class="row list-container">
            @if (session('success'))
                <div class="alert flash-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('message'))
                <div class="alert flash_error">
                    {{ session('message') }}
                </div>
            @endif

            <?php $i = 1; ?>
            <?php $m = 1; ?>
            <div class="col-md-11 lesson-wrap">
                @foreach ($lessons as $lesson)
                    <div class="lesson-container">
                        <div class="bg-key lesson-header">
                            <h2 class="ribbon">Lesson{{ $lesson->lesson_id }}</h2>
                            <p class="hour">目安時間：{{ $lesson->estimated_time }}H</p>
                        </div>
                        <?php $i++; ?>
                        <div class="lesson-list">
                            <h3>{{ $lesson->title }}</h3>
                            <div class="progress-container p-container<?php echo $m; ?>">
                                <div class="circle-container">
                                    <div class="progress-circle">
                                        @foreach ($post_count as $count)
                                            @if ($count->lesson_id == $lesson->lesson_id)
                                                <p class="circle circle-content1">
                                                    <span class="child<?php echo $m; ?> content2"></span>
                                                    <span class="slash">/</span>
                                                    <span class="content2">{{ $count->count }}</span>
                                                </p>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4 progress-group">
                                    <p class="progress-heading">達成度</p>
                                    {{-- <div class="overflow-x"> --}}
                                        @foreach ($posts as $post)
                                            {{-- レッスンと投稿のカテゴリーIDの一致 --}}
                                            @if ($lesson->lesson_id == $post->lesson_id)
                                                <a href="{{ Route('show.post', $post->slug) }}"
                                                    class="w-100 lesson-lead">
                                                    <div class="lesson-label">
                                                        <span>{{ $post->title }}</span>
                                                        @if (Auth::user()->chapter_id >= $post->chapter_id)
                                                            <div class="clear-container">
                                                                <p class="clear clear<?php echo $m; ?>">Clear！</p>
                                                            </div>
                                                        @else
                                                            <div class="clear-container">
                                                                <p>未達成</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </a>
                                            @endif
                                        @endforeach
                                        <?php $m++; ?>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

{{-- サイドバー --}}
@include('auth.sidebar')

{{-- フッターここに入る --}}
@include('auth.footer')
