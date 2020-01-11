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
                    <h1>ノストラダムス</h1>
                    <p>ルネサンス期フランスの医師、占星術師[注釈 1]、詩人。また料理研究の著作も
                        著している。日本では「ノストラダムスの大予言」の名で知られる詩集を著した。
                        彼の予言は、現在に至るまで非常に多くの信奉者を生み出し、様々な論争を引き起こしてきた。</p>
                    <i class="fa fa-hand-o-right "></i>
                    <a href="">read more</a>
                </div>
            </div>

            <!-- contents -->
            <div class="contents-box">
                <div class="content">
                    <i class="fa fa-copy yellow"></i>
                    <div class="content-text">
                        <h1>Article</h1>
                        <p>目的に応じて様々な角度から<br>
                            データを分析・解析します。</p>
                    </div>
                </div>
                <div class="content">
                    <i class="fa fa-book orange"></i>
                    <div class="content-text" style="margin-left: 2px;">
                        <h1>Word</h1>
                        <p>目的に応じて様々な角度から<br>
                            データを分析・解析します。</p>
                    </div>
                </div>
                <div class="content">
                    <i class="fa fa-pencil  green"></i>
                    <div class="content-text" style="margin-left: 6px;">
                        <h1>Test</h1>
                        <p>目的に応じて様々な角度から<br>
                            データを分析・解析します。</p>
                    </div>
                </div>
            </div>

            <div class="content-foot">

            </div>
        </div>
    </main>

    <!-- 他のscssはheader,footerでくくっているので下記のcssとコンフリクトしない -->
    <script src="/js/homeTop.js" type="text/javascript"></script>

    @component('components.footer')
    @endcomponent
@endsection
