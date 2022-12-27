@section('header')
    <nav class="pt-4">
        <div class="header-wrap">
            <div class="header-container">
                <a href="{{ url('/') }}">
                    <img class="app-logo" src="{{ asset('storage/images/logo_webCreate.png') }}" alt="WebCreate_Logo">
                </a>
                @guest
                    <div class="right-header" id="navbarSupportedContent">
                        <ul class="d-flex ms-auto">
                            <li class="nav-item login-menu">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        </ul>
                    </div>
                @else
                
                    <div class="course-container d-flex align-items-center">
                        <div class="header-course">
                            <form action="{{ Route('show.course') }}" method="post">
                                @csrf
                                <div class="d-flex align-items-center justify-content-between w-100">
                                    <div class="me-4 select-course">
                                        <select name="course_id" id="sources" class="w-100 text-center custom-select-trigger">
                                            <option value="1" selected>コースを選択</option>
                                            <option value="1">フロントエンドエンジニアコース</option>
                                            <option value="2">サーバサイドエンジニアコース</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn bg-key text-white switch-btn">切り替え</button>
                                </div>
                            </form>
                        </div>


                        
                    </div>

                    
                @endguest
            </div>
            <div class="w-100 header-menu-container" id="navbarSupportedContent">
             
                {{-- 波 --}}
                {{-- <svg class="header_wave" viewBox="0 0 1366 222" preserveAspectRatio="none" fill="none"
                    xmlns="https://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0 95.1429L46 116.028C91 137.686 182 179.456 273 179.456C364 179.456 455 137.686 546 121.443C637 105.972 729 116.028 820 132.272C911 147.742 1002 169.401 1093 184.871C1184 201.115 1275 211.171 1320 216.585L1366 222V0H1320C1275 0 1184 0 1093 0C1002 0 911 0 820 0C729 0 637 0 546 0C455 0 364 0 273 0C182 0 91 0 46 0H0V95.1429Z"
                        fill="#d9cbf2" />
                </svg> --}}
                <ul class="navbar-nav ms-auto">
                    <div class="header-list">
                        @guest
                        @else
                            <ul>
                            <li class="header-group">
                                    <a href="{{ url('/ranking') }}" class="header-link">
                                        <div class="link-icon"><i class="fa-solid fa-ranking-star"></i></div>
                                        <p>ランキング</p>
                                    </a>
                                </li>
                                <li class="header-group">
                                    <a href="{{ url('/meeting') }}" class="header-link">
                                        <div class="link-icon"><i class="fa-solid fa-comments"></i></div>
                                        <p>メンタリング</p>
                                    </a>
                                </li>
                                <li class="header-group">
                                    <a href="{{ route('show.report') }}" class="header-link">
                                        <div class="link-icon"><i class="fa-solid fa-calendar-week"></i></div>
                                        <p>ウィークリー</p>
                                    </a>
                                </li>
                                <li class="header-group">
                                    <a href="{{ route('show.contact') }}" class="header-link">
                                        <div class="link-icon"><i class="fa-solid fa-paper-plane"></i></div>
                                        <p>お問い合わせ</p>
                                    </a>
                                </li>
                                <li class="header-group">
                                    <a href="{{ url('/') }}" class="header-link">
                                        <div class="link-icon"><i class="bi bi-book-fill"></i></div>
                                        <p>カリキュラム一覧</p>
                                    </a>
                                </li>
                                <li class="header-group">
                                    <a href="{{ route('show.mypage') }}" class="header-link me-0">
                                        <div class="link-icon"><i class="fa-solid fa-user"></i></div>
                                        <p>マイページ</p>
                                    </a>
                                </li>
                            </ul>
                        @endguest
                    </div>
                </ul>
            </div>
        </div>
    </nav>
@endsection
