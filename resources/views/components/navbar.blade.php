
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

        <!-- toggle メニューが表示される-->
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
        <!-- toggle メニューが表示される-->

    </div>

    <!-- 検索結果表示 -->
    <section class="search" v-if="searchWord.length > 0">
        <ul>
            <li class="result" v-for="(searchResult, index) in searchResults" v-bind:key="index">
                <a :href="'searchArticleDetail/' + searchResult.title "
                    class="result-box">
                    <h1>
                        @{{ searchResult.title }}
                    </h1>
                    <p>
                        <div v-html="searchResult.snippet"></div>
                    </p>
                </a>
            </li>
        </ul>
    </section>
    <!-- 検索結果表示 -->

</header>

<script src="/js/header-toggle.js" type="text/javascript"></script>
