<footer>
    <ul class="row" id="footer-function">
        <li>
            <a href="/">
	            <i></i><br>
                <span>ホーム</span>
            </a>
        </li>

        <li class="menu-width-max">
            <a href="#" @click="switchFooterFunctionHighlight">
                <i></i><br>
                <span>ハイライト</span>
            </a>
        </li>

        <li>
 	        <a href="#" @click="switchFooterFunctionDictionary">
	            <i></i><br>
                <span>単語検索</span>
            </a>
        </li>

        <li>
            <a href="#" @click="saveArticle">
	            <i></i><br>
                <span class="mini-text">Follow</span>
            <a>
        </li>
    </ul>
</footer>

<script src="/js/footer-function.js" type="text/javascript"></script>
