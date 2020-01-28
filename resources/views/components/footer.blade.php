<footer>
    <ul class="row" id="footer-function">
        <li>
            <div>
	            <i></i><br>
                <span>ホーム</span>
            </div>
        </li>

        <li class="menu-width-max">
            <div @click="switchFooterFunctionHighlight">
                <i></i><br>
                <span>ハイライト</span>
            </div>
        </li>

        <li>
 	        <div @click="switchFooterFunctionDictionary">
	            <i></i><br>
                <span>単語検索</span>
            </div>
        </li>

        <li>
            <div @click="saveArticle">
	            <i></i><br>
                <span class="mini-text">Follow</span>
            <div>
        </li>
    </ul>
</footer>

<script src="/js/footer-function.js" type="text/javascript"></script>
