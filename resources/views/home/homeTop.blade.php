@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent

    <!--  まずは適当にボックスを並べる -->
    <main>
        <div class="row">

            <!-- top-image -->
            <div class="top-image">
                <div class="image-heading">
                    <div class="image-heading-block-icon">
                        <i class="fa fa-clock-o "></i>
                    </div>
                    <div class="image-heading-block-text">
                        <p class="text1">今日の一枚</p>
                        <p class="text2">コーヒーの写真</p>
                    </div>
                </div>
                <div class="image-heading-image">
                    <div class="title-box">
                        <h1>WikiEng</h1>
                        <p>contents_contents</p>
                    </div>
                    <img src="/images/cafe02.jpg" class="main-image">
                </div>
                <div class="image-heading-text">
                    <p>英語版wikipediaで英語を学習するためのアプリです。<br>
                        上の検索フォームで記事を検索してみましょう！</p>
                    <i class="fa fa-hand-o-right "></i>
                    <a href="/explain">アプリの使い方について</a>
                </div>
            </div>

            <!-- contents -->
            <div class="contents-box">
                <div class="content">
                    <i class="fa fa-eyedropper green"></i>
                    <div class="content-text">
                        <h1>ハイライト機能</h1>
                        <p>ハイライトを書き込み、消去できます<br>
                            構文解析などでご利用ください</p>
                    </div>
                </div>
                <div class="content">
                    <i class="fa fa-book green"></i>
                    <div class="content-text" style="margin-left: 2px;">
                        <h1>単語検索機能</h1>
                        <p>記事内の単語について意味を検索でき<br>
                            ます</p>
                    </div>
                </div>
                <div class="content">
                    <i class="fa fa-database green"></i>
                    <div class="content-text" style="margin-left: 6px;">
                        <h1>意味、例文保存機能</h1>
                        <p>検索した単語の意味と例文を保存でき<br>
                            ます</p>
                    </div>
                </div>
            </div>
            <!-- contents -->

            <div class="content-foot">

            </div>
        </div>
    </main>

    <!-- 他のscssはheader,footerでくくっているので下記のcssとコンフリクトしない -->

    @component('components.footer')
    @endcomponent
@endsection
