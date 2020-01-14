var head = new Vue({
    el: 'header',

    data: {
        toggle: false,

        /* 記事検索用データ */
        searchWord: "",
        searchResults: [],
        /* 記事検索用データ */
    },

    // 記事検索用関数
    watch: {
        searchWord: function(newSearch) {
            this.searchResults = [];

            // queryの各パラメータを用いてwikiAPIを検索
            axios.get("/api/searchArticle/" + newSearch)
                 .then((response) => {
                     for(var i = 0; i < 8; i++) {
                     // 検索結果から８つだけ取って配列に入れる
                     if (this.searchResults.length < 8) {
                        this.searchResults.push(response.data.query.search[i]);
                     } else {
                        this.searchResults.shift();
                        this.searchResults.push(response.data.query.search[i]);
                     }
                 }})
                 .catch(response => console.log(response));
        }
    },

    // 右上の三本線を押してメニューを出す関数
    methods: {
        handleResize: function() {
            // 750(三本線ライン)を越えるとtoggleがtrue（メニュー常に表示）になる
            if (window.innerWidth >= 750) {
                this.toggle = true
            } else {
                this.toggle = false
            }
        }
    },

    created() {
        // サイズを変えるとthis.handleResizeでチェックするよう設定
        window.addEventListener('resize', this.handleResize)
        // ついでにページ開いた時にもthis.handleResizeする
        this.handleResize()
    },

    destroyed() {
        window.removeEventListener('resize', this.handleResize)
    }
})
