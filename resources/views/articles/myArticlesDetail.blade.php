@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent
    <div id="showArticleDetail">
        <div @mousedown="selected" @click="clicked" @touchstart="selected" @touchmove="clicked">
            {!! $article->article !!}
        </div>
    </div>
    <!-- 記事編集保存用の印 外すと壊れる-->
    <div style="height: 133px;">
    </div>

    <!-- 登録単語一覧を見る -->
    <a href="/words/{{ $article->id }}" class="word-button word-index-button">
        <i class="fa fa-book "></i>
    </a>

    @component('components.dictionary')
    @endcomponent

    <!-- js -->
    <script src="/js/showArticleDetail.js" type="text/javascript"></script>

    <!-- css -->
    <link href="/css/wikipediaArticle.css" rel="stylesheet" type="text/css">
    @component('components.footerEdit')
    @endcomponent
@endsection
