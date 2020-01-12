@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent

    <section class="search">
        <ul>
            <li class="result">
                <div class="result-box">
                    <h1>
                        あ
                    </h1>
                    <p>
                        size（記事サイズ）, wordcount（記事の単語数）, timestamp（記事の最終更新日時）, score（検索エンジンのスコア）, snippet（記事中の検索語を含む部分）
                    </p>
                </div>
            </li>
            <li class="result">
                <div class="result-box">
                    <h1>
                        あ
                    </h1>
                    <p>
                        size（記事サイズ）, wordcount（記事の単語数）, timestamp（記事の最終更新日時）, score（検索エンジンのスコア）, snippet（記事中の検索語を含む部分）
                    </p>
                </div>
            </li>
            <li class="result">
                <div class="result-box">
                    <h1>
                        あ
                    </h1>
                    <p>
                        size（記事サイズ）, wordcount（記事の単語数）, timestamp（記事の最終更新日時）, score（検索エンジンのスコア）, snippet（記事中の検索語を含む部分）
                        size（記事サイズ）, wordcount（記事の単語数）, timestamp（記事の最終更新日時）, score（検索エンジンのスコア）, snippet（記事中の検索語を含む部分）
                    </p>
                </div>
            </li>
        </ul>
    </section>

    @component('components.footer')
    @endcomponent
@endsection
