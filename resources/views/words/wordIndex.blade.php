@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="myArticles">
        <div class="userName">
            <div class="userNameBox">
                <h1>単語一覧</h1>
            </div>
        </div>
        <ul>
            @foreach ($words as $word)
                <li class="result">
                    <div class="buttons">
                        <i class="fa fa-hand-o-right "></i>
                        <form action="/words/{{ $word->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit">
                                <i class="fa fa-times-circle-o "></i>
                            </button>
                        </form>
                    </div>
                    <a class="result-box" href="/">
                        <div class="result-box-text">
                            <h1>{{ $word->word }}</h1>
                            <p>{{ $word->sampletext }}</p>
                        </div>
                    </a>
                </li>
            @endforeach
            <li style="height: 300px; background-color: #eee; border: none;">
            </li>
        </ul>

        <!-- 元の記事に戻る -->
        <a href="/articles/{{ $word->article_id }}" class="word-button word-article-button">
            <i class="fa fa-reply "></i>
        </a>
    </div>

    @component('components.footer')
    @endcomponent
@endsection
