@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="myArticles">
        <div class="userName">
            <div class="userNameBox">
                <h1>◯◯さんの記事一覧</h1>
            </div>
        </div>
        <ul>
            @foreach ($articles as $article)
                <li class="result">
                    <a　class="result-box">
                        <h1>
                            <a href="/articles/{{ $article->id }}">{{ $article->title }}</a>
                        </h1>
                        <p>
                            {{ $article->summary }}
                        </p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @component('components.footer')
    @endcomponent
@endsection
