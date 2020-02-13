@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="myArticles">
        <div class="userName">
            <div class="userNameBox">
                <h1>{{ Auth::user()->name }}さんの記事一覧</h1>
            </div>
        </div>
        <ul>
            @foreach ($articles as $article)
                <li class="result">
                    <div class="result-box">
                        <div class="result-box-text">
                            <div class="buttons">
                                <form action="/articles/{{ $article->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit">
                                        <i class="fa fa-times-circle-o "></i>
                                    </button>
                                </form>
                            </div>
                            <h1>{{ $article->title }}</h1>
                            <a href="/articles/{{ $article->id }}">{{ $article->summary }}</a>
                        </div>
                    </div>
                    @if ( count($article->words) > 0 )
                        <div class="article-fold">
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
        <div style="height: 300px; background-color: #eee; border: none;">
        </div>
    </div>

    @component('components.footer')
    @endcomponent
@endsection
