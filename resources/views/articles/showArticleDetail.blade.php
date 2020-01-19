@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent
        <div id="showArticleDetail">
            <div @click="selected">
                <div v-html="showArticleDetail"></div>
            </div>
        </div>

        <!-- js -->
        <script src="/js/showArticleDetail.js" type="text/javascript"></script>

        <!-- css -->
        <link href="/css/wikipediaArticle.css" rel="stylesheet" type="text/css">
    @component('components.footer')
    @endcomponent
@endsection
