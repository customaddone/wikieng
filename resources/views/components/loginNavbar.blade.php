
<link href='https://fonts.googleapis.com/css?family=Montserrat|Cardo' rel='stylesheet' type='text/css'>


<header id="header">

    <div class="row">
        <div class="logo">
            <div class="find">
                <a href="/">W/E</a>
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
                @guest
                    <li class="loginbutton">
                        <a href="/login">ログイン</a>
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
</header>

<script src="/js/header-toggle.js" type="text/javascript"></script>
