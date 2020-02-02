
<link href='https://fonts.googleapis.com/css?family=Montserrat|Cardo' rel='stylesheet' type='text/css'>


<header id="header">

    <div class="row">
        <div class="logo">
            <div class="find">
                <a href="#">W/E</a>
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
                <li><i class="fa fa-user "></i></li>
                <li>
                    @guest
                        <p>guest</p>
                    @endguest
                    @auth
                        <p>{{ Auth::user()->name }}</p>
                    @endauth
                </li>
                <li class="loginbutton">
                    @guest
                        <a href="/login">ログイン</a>
                    @endguest
                    @auth
                        <form action="/logout" method="POST">
                            <button type="submit" class="login-button">
                                @csrf
                                <p>ログアウト</p>
                            </button>
                        </form>
                    @endauth
                </li>
                <li class="loginbutton loginbutton-last"><a href="/register">新規登録</a></li>
            </ul>
        </nav>
        <!-- toggle メニューが表示される-->

    </div>

    <!-- 検索結果表示 -->
    <section class="search" v-if="searchWord.length > 0">
        <ul>
            <li class="result" v-for="(searchResult, index) in searchResults" v-bind:key="index">
                <a :href="'/searchArticleDetail/' + searchResult.title "
                    class="result-box">
                    <h1>
                        @{{ searchResult.title }}
                    </h1>
                    <div class="result-box-text" v-html="searchResult.snippet"></div>
                </a>
            </li>
        </ul>
    </section>
    <!-- 検索結果表示 -->

</header>

<script src="/js/header-toggle.js" type="text/javascript"></script>
