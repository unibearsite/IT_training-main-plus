@section('sidebar')
    <div class="animal-img">
        <div class="animal-img-container">
            <img src="{{ asset('storage/images/gollira.gif') }}" alt="ゴリラ">
        </div>
        <div class="balloon3-right-btm">
            <p><?php
            $date = date('w');
            if ($date == 0) {
                echo '日曜日！' . "\n" . 'ねえ、あのさ、、' . "\n" . 'ウィークリー出した、、？';
            } elseif ($date == 1) {
                echo '月曜日、' . "\n" . '今日から仕事がんばろう';
            } elseif ($date == 2) {
                echo '火曜日、' . "\n" . '本日もお疲れ様でした';
            } elseif ($date == 3) {
                echo '水曜日、週の真ん中だね。疲れてきてるけど少しだけやろ！';
            } elseif ($date == 4) {
                echo '木曜日、' . "\n" . '気持ちは週末に向かってます';
            } elseif ($date == 5) {
                echo '金曜日！' . "\n" . '今日からウィークリー出せるんだよー';
            } elseif ($date == 6) {
                echo '土曜日、' . "\n" . 'しっかり寝てしっかり進めて最高の一日にしよう';
            }
            ?></p>
        </div>
    </div>

    <div class="side-container">
        <div class="side-menu">
            <nav>
                <ul class="side-navi">
                    {{-- ログイン日 --}}
                    <li>
                        <p>{{ Auth::user()->nickname }}さん</p>
                    </li>

                    {{-- カリキュラム一覧（home）画面 --}}
                    <li><a href="{{ url('/') }}">
                            カリキュラム一覧
                        </a></li>
                    {{-- 検索サイト --}}
                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            検索サイト まとめ
                        </a>

                        <div class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="navbarDropdown">
                            <h3>学習中の調べもの</h3>
                            <a class="dropdown-item pb-2" href="https://qiita.com/">
                                Qiita（キータ）<span class="red">おすすめ！</span>
                            </a>
                            <a class="dropdown-item pb-2" href="https://techacademy.jp/magazine/">
                                テックアカデミーマガジン
                            </a>


                            <h3 class="mt-2">用語辞典</h3>

                            <a class="dropdown-item pb-2" href="https://wa3.i-3-i.info/">
                                「分かった」気になれるIT用語辞典
                            </a>

                            <a class="dropdown-item" href="https://www.otsuka-shokai.co.jp/words/">
                                大塚商会 IT用語辞典
                            </a>
                        </div>
                    </li>
                    <li><a href="{{ Route('show.contact') }}">お問い合わせ</a></li>
                    <li class="">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
