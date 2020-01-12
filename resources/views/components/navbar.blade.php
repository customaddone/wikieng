
<link href='https://fonts.googleapis.com/css?family=Montserrat|Cardo' rel='stylesheet' type='text/css'>


<header id="header">

    <div class="row">
        <div class="logo">
            <div class="find">
                <a href="#">P/F</a>
                <form method="get" action="#" class="search_container">
                    <input class="input-form" type="text" size="25" v-model="searchWord">
                    <i class="fa fa-search "></i>
                </form>
            </div>
        </div>

        <div @click="toggle=!toggle" class="mobile-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <nav v-if="toggle" class="toggle">
            <ul>
                <li><a href=".sec01">Section 01</a></li>
                <li><a href=".sec02">Section 02</a></li>
                <li><a href=".sec03">Section 03</a></li>
                <li><a href=".sec04">Section 04</a></li>
            </ul>
        </nav>
    </div> <!-- / row -->

    <section class="search" v-if="searchWord.length > 0">
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

</header>

<script src="/js/header-toggle.js" type="text/javascript"></script>
