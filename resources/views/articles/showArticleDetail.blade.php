@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent
        <div id="showArticleDetail">
            <div v-html="showArticleDetail"></div>
        </div>

        <script src="/js/showArticleDetail.js" type="text/javascript"></script>

        <link href="/css/wikipediaArticle.css" rel="stylesheet" type="text/css">
    @component('components.footer')
    @endcomponent
@endsection
