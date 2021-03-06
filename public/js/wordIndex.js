var head = new Vue({
  el: '#wordIndex',

  data: {
    // 登録単語の配列
    words: [],
    // toggle用
    showWordsProperty: [],
  },

  mounted: function() {
    this.indexWord()
  },

  methods: {
    indexWord: function() {
      var articleId = location.pathname.split('/')

      axios
        .get('/api/words/' + articleId[2])
        .then(response => {
          // リダイレクトはまずい

          this.words = response.data
          this.showWordsProperty = []
          for (var i = 0; i < response.data.length; i++) {
            this.showWordsProperty.push(0)
          }
        })
        .catch(response => {
          console.log(response)
        })
    },

    deleteWord: function(id) {
      axios
        .delete('/api/words/' + id)
        .then(response => {
          this.indexWord()
        })
        .catch(response => console.log(response))
    },

    showSwitchMean: function(index) {
      // ただ値を変えるだけでは再描画されないのでspliceを使う
      this.showWordsProperty.splice(index, 1, 0)
    },

    showSwitchSampleText: function(index) {
      this.showWordsProperty.splice(index, 1, 1)
    },
  },
})
