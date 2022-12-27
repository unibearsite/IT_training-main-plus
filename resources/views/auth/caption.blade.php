@section('caption')
    {{-- 目次 --}}
    <div class="caption-container">
        <div class="side-menu">
            <nav>
                <div class="caption">
                    {{-- <h4 class="caption-title">目次</h4> --}}
                    <ul class="caption-navi w-100 mt-4 text-left caption_list">
                        @foreach (App\Models\Post::getCaption($posts->body) as $caption)
                            <li class="caption-li">
                                <a class="caption_{{ $caption[1] }}" href="#{{ $caption[2] }}">{{ $caption[2] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </div>

@endsection
