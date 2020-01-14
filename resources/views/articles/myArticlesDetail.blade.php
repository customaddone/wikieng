@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent
    <div>
        {!! $article->article !!}
    </div>

    <!-- css -->
    <link href="/css/wikipediaArticle.css" rel="stylesheet" type="text/css">
    @component('components.footer')
    @endcomponent
@endsection
