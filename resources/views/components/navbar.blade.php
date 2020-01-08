
<link href='https://fonts.googleapis.com/css?family=Montserrat|Cardo' rel='stylesheet' type='text/css'>


<header>

    <div class="row"　id="header">
        <a class="logo" href="#">P/F</a>

        <div @click="toggle=!toggle" class="mobile-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <nav v-if="toggle">
            <ul>
                <li><a href=".sec01">Section 01</a></li>
                <li><a href=".sec02">Section 02</a></li>
                <li><a href=".sec03">Section 03</a></li>
                <li><a href=".sec04">Section 04</a></li>
            </ul>
        </nav>

    </div> <!-- / row -->

</header>

<script src="/js/header-toggle.js" type="text/javascript"></script>
