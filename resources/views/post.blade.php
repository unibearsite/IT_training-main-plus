@extends('layouts.addSide')
@include('auth.head')
@include('auth.header')
@section('content')
    <div class="container col-lg-8 posts-wrapper">
        @if (session('success'))
            <div class="alert flash-success w-100">
                {{ session('success') }}
            </div>
        @endif
        <div class="card py-5 px-3">
            <div class="card-body posts-container">
                <article id="posts">

                    <div class="posts-title">
                        <h1><span class="lesson-name">Lesson.{{ $posts->lesson_id }}</span> {{ $posts->title }}</h1>
                    </div>
                    <div class="posts-article">
                        <!-- 内容 -->
                        <div class="content chapter-container">
                            {!! App\Models\Post::getContentHtml($posts->body) !!}
                        </div>
                    </div>
                    <div class="posts-content">
                        <form action="{{ route('success.lesson', $posts->slug) }}" method="post" name="progress">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="post_id" value="{{ $posts->id }}">
                            <input type="hidden" name="lesson_id" value="{{ Auth::user()->lesson_id }}">
                            <input type="hidden" name="course_id" value="{{ $posts->course_id }}">
                            <input type="hidden" name="chapter_id" value="{{ $posts->chapter_id }}">

                            @if (Auth::user()->chapter_id >= $posts->chapter_id)
                                <button id="chapterBtn" type="button" class="btn-lg bg-key chapterBtn click-none">
                                    完了済み
                                </button>
                            @elseif(Auth::user()->chapter_id + 1 == $posts->chapter_id)
                                <button id="chapterBtn" type="submit" class="btn-lg bg-sub2 chapterBtn">
                                    このチャプターを完了する
                                </button>
                            @else
                                <button id="chapterBtn" type="button" class="btn-lg bg-sub2 chapterBtn click-none">
                                    前のチャプターを完了してください。
                                </button>
                            @endif
                        </form>
                    </div>
                </article>
            </div>
        </div>
        <div class="next-btn d-flex justify-content-center">
            <form action="{{ Route('prev.post', $posts->slug) }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $posts->id }}">
                <input type="hidden" name="course_id" value="{{ $posts->course_id }}">
                <input type="hidden" name="slug" value="{{ $posts->slug }}">
                <input type="hidden" name="chapter_id" value="{{ $posts->chapter_id - 1 }}">
                <button class="btn bg-key2 nextBtn me-5" type="submit"><i
                        class="bi bi-arrow-left-circle me-2"></i>前のチャプター</button>
            </form>
            <form action="{{ Route('next.post', $posts->slug) }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $posts->id }}">
                <input type="hidden" name="course_id" value="{{ $posts->course_id }}">
                <input type="hidden" name="slug" value="{{ $posts->slug }}">
                <input type="hidden" name="chapter_id" value="{{ $posts->chapter_id + 1 }}">
                <button class="btn bg-key nextBtn" type="submit">次のチャプター<i
                        class="bi bi-arrow-right-circle ms-2"></i></button>
            </form>
        </div>
    </div>
@endsection
{{-- サイドバー --}}
@include('auth.sidebar')
@include('auth.caption')

{{-- フッターここに入る --}}
@include('auth.footer')
