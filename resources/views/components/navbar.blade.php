
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
                @guest
                    <li><p>guest</p></li>
                    <li class="loginbutton">
                        <a href="/login">ログイン</a>
                    </li>
                    <li class="loginbutton loginbutton-last">
                        <form method="POST" action="/login">
                            @csrf
                            <input name="email" type="hidden" value="laravel@gmail.com">
                            <input name="password" type="hidden" value="laravelpassword">
                            <button type="submit">簡単ログイン</button>
                        </form>
                    </li>
                    <li class="loginbutton loginbutton-last">
                        <a href="/register">新規登録</a>
                    </li>
                @endguest
                @auth
                    <li><p>{{ Auth::user()->name }}</p></li>
                    <li>
                        <form action="/logout" method="POST">
                            <button type="submit" class="login-button">
                                @csrf
                                <p>ログアウト</p>
                            </button>
                        </form>
                    </li>
                @endauth
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
