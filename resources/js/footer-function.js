var foot = new Vue({
  el: '#footer-function',

  data: {
    switchFooterFunction: 0,
  },

  methods: {
    // ハイライトと単語検索（とアクションなし）を切り替える
    // なんでfootの値をdictionaryインスタンスに渡せないんですか
    switchFooterFunctionHighlight: function() {
      if (this.switchFooterFunction != 1) {
        this.switchFooterFunction = 1
        dictionary.switchFooterFunction = 1
      } else {
        this.switchFooterFunction = 0
        dictionary.switchFooterFunction = 0
      }
    },
    switchFooterFunctionDictionary: function() {
      if (this.switchFooterFunction != 2) {
        this.switchFooterFunction = 2
        dictionary.switchFooterFunction = 2
      } else {
        this.switchFooterFunction = 0
        dictionary.switchFooterFunction = 0
      }
    },

    // 記事のインポート
    saveArticle: function() {
      axios
        .post('/api/articles/import', {
          title: vm.articleTitle,

          // wikiの記事のaリンクを消す replaceは非破壊的メソッド
          article: vm.showArticleDetail
            .toString()
            .replace(/<a[\s\S]*?>/g, '')
            .replace(/<\/a>/g, ''),

          summary: vm.summary,
          status: 'wiki',
        })
        .then(response => {
          alert('インポートしました！！')
        })
        .catch(function(error) {
          console.log(error)
        })
    },
  },
  // 記事のインポート
})
