@section('footer')
        <div id="footer">
            <div class="footer-wrap">
                <div class="footer-container">
                    <div class="footer-menu">
                        <nav>
                            <ul class="footer-navi">

                                @guest
                                <li><a href="{{ route('show.contact') }}">お問い合わせ</a></li>
                                <li><a href="https://libero-net.com/">運営会社</a></li>
                                @else
                                <li><a href="{{ url('/meeting') }}">メンタリング</a></li>
                                <li><a href="{{ route('show.report') }}">ウィークリー</a></li>
                                <li><a href="{{ url('/') }}">カリキュラム一覧</a></li>
                                <li><a href="{{ route('show.mypage') }}">マイページ</a></li>
                                <li><a href="{{ route('show.contact') }}">お問い合わせ</a></li>
                                <li><a href="https://libero-net.com/">運営会社</a></li>
                                @endguest
                            </ul>
                        </nav>
                    </div>
                        
                    <div class="copy-light">
                        <small class="copy">Copyright © Web Create All Rights Reserved.​</small>
                    </div>
                </div>
            </div>
        </div>
    <div id="topBtn">
        <p><i class="bi bi-chevron-bar-up"></i></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    
@endsection
