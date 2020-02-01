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

    <!-- コンポーネント化できない？ -->
    <div class="dictionary" id="dictionary" >
        <div class="dictionary-card" v-if="switchFooterFunction == 2">
            <div class="dictionary-header">
                <i class="fa fa-comment-o "></i>
            </div>
            <div class="dictionary-text">
                <div class="dictionary-title"  @click="saveWord">
                    <p>@{{ seeWord }}</p>
                </div>
                <div class="dictionary-article">
                    <p>@{{ translatedWord }}</p>
                </div>
            </div>
            <div class="dictionary-footer">
                <i class="fa fa-edit "></i>
                <p>See more</p>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="/js/showArticleDetail.js" type="text/javascript"></script>
    <script src="/js/dictionary.js" type="text/javascript"></script>

    <!-- css -->
    <link href="/css/wikipediaArticle.css" rel="stylesheet" type="text/css">
    @component('components.footerEdit')
    @endcomponent
@endsection
