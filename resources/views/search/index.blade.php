@extends('layouts.app')
@include('auth.head')
@include('auth.header')

@section('content')
    <div class="container col-lg-6 col-md-10">
        <div class="search-container">
            <h2><span>"{{ request('query') }}"</span>について{{ $searchResults->count() }} 件の検索結果がありました。</h2>
            <div class="card-body">
                @foreach ($searchResults->groupByType() as $type => $modelSearchResults)
                    @foreach ($modelSearchResults as $searchResult)
                        <ul>
                            <li><a href="{{ $searchResult->url }}">
                                    {{ $searchResult->title }}

                                </a>
                            </li>
                            {{-- <li>  {{ $searchResult->lesson_id }}</li> --}}
                        </ul>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection


{{-- フッターここに入る --}}
@include('auth.footer')
