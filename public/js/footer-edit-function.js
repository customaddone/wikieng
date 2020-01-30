var foot = new Vue({
    el: '#footer-function',

    data: {
      switchFooterFunction: 0,
    },

    methods: {
        // ハイライトと単語検索（とアクションなし）を切り替える
        // なんでfootの値をdictionaryインスタンスに渡せないんですか
        switchFooterFunctionHighlight: function () {
            if (this.switchFooterFunction != 1) {
                this.switchFooterFunction = 1
                dictionary.switchFooterFunction = 1
            } else {
                this.switchFooterFunction = 0
                dictionary.switchFooterFunction = 0
            }
        },
        switchFooterFunctionDictionary: function () {
            if (this.switchFooterFunction != 2) {
                this.switchFooterFunction = 2
                dictionary.switchFooterFunction = 2
            } else {
                this.switchFooterFunction = 0
                dictionary.switchFooterFunction = 0
            }
        },

        // ハイライト編集結果の反映
        // 画面全体から.match(/mw-parser-output[\s\S]+height: 133px/)の部分だけを抽出して保存
        // ハイライトごと保存される
        editArticle: function () {

           var nowPageHTML = document.body.innerHTML
              　             .match(/mw-parser-output[\s\S]+height: 133px/)

           // IDの取得方法が胡散臭い
           var articleId= location.pathname.split("/");

           var nowpage = '<div class="' + nowPageHTML + '-->';

           axios.post('/api/articles/edit',{
             id: articleId[2],
             article: nowpage,
           }).then((response) => {
               alert('編集しました！！');
           }).catch((response) => {
               console.log(response);
           });
        }
    }
})
