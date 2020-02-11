@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent
        <div id="showArticleDetail" v-cloak>
            <div @mousedown="selected" @click="clicked" @touchstart="selected" @touchmove="clicked">
                <div v-html="showArticleDetail"></div>
            </div>
        </div>

        @component('components.dictionary')
        @endcomponent

        <!-- js -->
        <script src="/js/showArticleDetail.js" type="text/javascript"></script>

        <!-- css -->
        <link href="/css/wikipediaArticle.css" rel="stylesheet" type="text/css">
    @component('components.footer')
    @endcomponent
@endsection
