@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent
        <div id="showArticleDetail">
            <div @mousedown="selected" @click="clicked" @touchstart="selected" @touchmove="clicked">
                <div v-html="showArticleDetail"></div>
            </div>
        </div>

        <div class="dictionary">
            <div class="dictionary-card">
                <div class="dictionary-header">
                    <i class="fa fa-comment-o "></i>
                </div>
                <div class="dictionary-text">
                    <div class="dictionary-title">
                        <p>excellent</p>
                    </div>
                    <div class="dictionary-article">
                        <p>singer. He debuted in 2007 and has since become known for his chart-topping ballads.[2] He has also been dubbed the </p>
                    </div>
                </div>
                <div class="dictionary-footer">
                    <i class="fa fa-edit "></i>
                    <p>参考書 p42</p>
                </div>
            </div>
        </div>

        <!-- js -->
        <script src="/js/showArticleDetail.js" type="text/javascript"></script>

        <!-- css -->
        <link href="/css/wikipediaArticle.css" rel="stylesheet" type="text/css">
    @component('components.footer')
    @endcomponent
@endsection
