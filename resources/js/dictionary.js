var dictionary = new Vue({
  el: '#dictionary',

  data: {
    switchFooterFunction: 0,
    seeWord: 'Search',
    translatedWord: '',

    // ハイライトの色
    nowHighlightColor: "#FF89FF",
    // ハイライトの色の配列
    highlightColor: ["#FF89FF", "#89DB89", "#90AFEE", "#C8AAF2", "#8BDEDE", "#FF9999"],
  },

  methods: {
    // ハイライトと単語検索（とアクションなし）を切り替える
    /* 単語を辞書で検索 */
    searchWordMean: function(seeWord) {
      this.seeWord = seeWord
      /* 選択した単語が名詞の複数形、動詞の過去形だった場合整形 */
      var translateCut = function(word) {
        /* 配列の中の要素が末尾にあれば切り取る */
        var endword = ['ing', 'es', 's', 'ed', 'd', ' ']

        for (var i = 0; i < endword.length; i++) {
          /* 配列の中の要素が末尾にあるか、配列の前から順に調べていく
          あれば末尾を切り取りfunctionの戻り値にしてループを抜ける */
          var pattern = new RegExp('^(.+)' + endword[i] + '$')
          var searchWord = word.match(pattern)
          if (searchWord) {
            var cuttedWord = searchWord[0].replace(pattern, '$1')
            return cuttedWord
          }
        }

        /* ヒットしなければ入力した語をそのまま返す */
        return seeWord
      }

      /* まず入力された単語を検索する。無ければ、整形後の単語で検索
            それでも無ければ「検索に一致する項目は...」を表示 */
      this.researchAxios(seeWord).catch(() => {
        this.researchAxios(translateCut(seeWord)).catch(() => {
          this.translatedWord = '検索に一致する項目はありませんでした...'
        })
      })
    },

    /* デ辞蔵を使って単語検索->ヒットすればIDを取得して単語のページを検索
        Guzzleを使ってクロスオリジン通信を行う */
    researchAxios: function(word) {
      return new Promise((resolve, reject) => {
        axios
          .get('/api/wordIdSearch/' + word)
          .then(response => {
            /* 戻ってきたデータからIDを取得 */
            var searchId = response.data.match(/(\d{6})/)
            var searchWordId = searchId[0]

            /* IDを用いて単語のページを検索 */
            axios
              .get('/api/wordSearch/' + searchWordId)
              .then(response => {
                var means = response.data.match(/<div>(.*?)<\/div>/)
                // 検索結果を収納
                this.translatedWord = means[1]
                resolve()
              })
              .catch(response => console.log(response))
          })
          .catch(response => {
            console.log(response)
            reject()
          })
      })
    },

    // 単語の保存
    saveWord: function(event) {
      var articleId = location.pathname.split('/')
      var wordMean =  (this.translatedWord !== '検索に一致する項目はありませんでした...')?
        this.translatedWord : ''

      axios
        .post('/api/words/create', {
          word: this.seeWord,
          mean: wordMean.slice(0, 140).concat('.'),
          sampletext: vm.seeWordsSampleText,
          article_id: articleId[2],
        })
        .then(() => {
          // v-bindにすると色が戻らなかった
          event.target.style.boxShadow= '0 0 50px #00CCAA';
          setTimeout(() => {
            event.target.style.boxShadow = '0 0 8px #00CCAA';
          }, 200);
        })
        .catch(response => {
          event.target.style.boxShadow = '0 0 50px #CC297A';
          setTimeout(() => {
            event.target.style.boxShadow = '0 0 8px #00CCAA';
          }, 200);
          console.log(response)
        })
    },

    // ハイライトの色変更
    switchHighlightColor: function(colorId) {
      this.nowHighlightColor = this.highlightColor[colorId]
    }
  },

})
