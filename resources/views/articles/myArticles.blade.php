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
                    <div class="buttons">
                        <i class="fa fa-hand-o-right "></i>
                        <form action="/articles/{{ $article->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit">
                                <i class="fa fa-times-circle-o "></i>
                            </button>
                        </form>
                    </div>
                    <a class="result-box" href="/articles/{{ $article->id }}">
                        <div class="result-box-text">
                            <h1>{{ $article->title }}</h1>
                            <p>{{ $article->summary }}</p>
                        </div>
                    </a>
                </li>
            @endforeach
            <li style="height: 300px; background-color: #eee; border: none;">
            </li>
        </ul>
    </div>

    @component('components.footer')
    @endcomponent
@endsection
