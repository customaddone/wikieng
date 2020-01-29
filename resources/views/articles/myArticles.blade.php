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
                    <div class="buttons">
                        <i class="fa fa-hand-o-right "></i>
                        <form action="/articles/{{ $article->id }}" method="POST" class="form-horizontal">
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
                            <p>text-decorationプロパティは CSS1 や CSS2 から存在していますが、 CSS3 からはテキストの線・色・スタイルをまとめて指定できるショートハンド（短縮形）プロパティとして使用できます。</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @component('components.footer')
    @endcomponent
@endsection
