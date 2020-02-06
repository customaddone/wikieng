/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/dictionary.js":
/*!************************************!*\
  !*** ./resources/js/dictionary.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var dictionary = new Vue({
  el: '#dictionary',
  data: {
    switchFooterFunction: 0,
    seeWord: 'Search',
    translatedWord: ''
  },
  methods: {
    // ハイライトと単語検索（とアクションなし）を切り替える

    /* 単語を辞書で検索 */
    searchWordMean: function searchWordMean(seeWord) {
      var _this = this;

      this.seeWord = seeWord;
      /* 選択した単語が名詞の複数形、動詞の過去形だった場合整形 */

      var translateCut = function translateCut(word) {
        /* 配列の中の要素が末尾にあれば切り取る */
        var endword = ['ing', 'es', 's', 'ed', 'd', ' '];

        for (var i = 0; i < endword.length; i++) {
          /* 配列の中の要素が末尾にあるか、配列の前から順に調べていく
            　　       あれば末尾を切り取りfunctionの戻り値にしてループを抜ける */
          var pattern = new RegExp('^(.+)' + endword[i] + '$');
          var searchWord = word.match(pattern);

          if (searchWord) {
            var cuttedWord = searchWord[0].replace(pattern, '$1');
            return cuttedWord;
          }
        }
        /* ヒットしなければ入力した語をそのまま返す */


        return seeWord;
      };
      /* まず入力された単語を検索する。無ければ、整形後の単語で検索
            それでも無ければ「検索に一致する項目は...」を表示 */


      this.researchAxios(seeWord)["catch"](function () {
        _this.researchAxios(translateCut(seeWord))["catch"](function () {
          _this.translatedWord = '検索に一致する項目はありませんでした...';
        });
      });
    },

    /* デ辞蔵を使って単語検索->ヒットすればIDを取得して単語のページを検索
        Guzzleを使ってクロスオリジン通信を行う */
    researchAxios: function researchAxios(word) {
      var _this2 = this;

      return new Promise(function (resolve, reject) {
        axios.get('/api/wordIdSearch/' + word).then(function (response) {
          /* 戻ってきたデータからIDを取得 */
          var searchId = response.data.match(/(\d{6})/);
          var searchWordId = searchId[0];
          /* IDを用いて単語のページを検索 */

          axios.get('/api/wordSearch/' + searchWordId).then(function (response) {
            var means = response.data.match(/<div>(.*?)<\/div>/); // 検索結果を収納

            _this2.translatedWord = means[1];
            resolve();
          })["catch"](function (response) {
            return console.log(response);
          });
        })["catch"](function (response) {
          console.log(response);
          reject();
        });
      });
    },
    // 単語の保存
    saveWord: function saveWord() {
      var articleId = location.pathname.split('/');
      axios.post('/api/words/create', {
        word: this.seeWord,
        mean: this.translatedWord,
        sampletext: vm.seeWordsSampleText,
        article_id: articleId[2]
      }).then(function (response) {
        alert('OK');
      })["catch"](function (response) {
        console.log(response);
      });
    }
  } // 記事のインポート

});

/***/ }),

/***/ "./resources/js/footer-edit-function.js":
/*!**********************************************!*\
  !*** ./resources/js/footer-edit-function.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var foot = new Vue({
  el: '#footer-function',
  data: {
    switchFooterFunction: 0
  },
  methods: {
    // ハイライトと単語検索（とアクションなし）を切り替える
    // なんでfootの値をdictionaryインスタンスに渡せないんですか
    switchFooterFunctionHighlight: function switchFooterFunctionHighlight() {
      if (this.switchFooterFunction != 1) {
        this.switchFooterFunction = 1;
        dictionary.switchFooterFunction = 1;
      } else {
        this.switchFooterFunction = 0;
        dictionary.switchFooterFunction = 0;
      }
    },
    switchFooterFunctionDictionary: function switchFooterFunctionDictionary() {
      if (this.switchFooterFunction != 2) {
        this.switchFooterFunction = 2;
        dictionary.switchFooterFunction = 2;
      } else {
        this.switchFooterFunction = 0;
        dictionary.switchFooterFunction = 0;
      }
    },
    // ハイライト編集結果の反映
    // 画面全体から.match(/mw-parser-output[\s\S]+height: 133px/)の部分だけを抽出して保存
    // ハイライトごと保存される
    editArticle: function editArticle() {
      var nowPageHTML = document.body.innerHTML.match(/mw-parser-output[\s\S]+height: 133px/); // IDの取得方法が胡散臭い

      var articleId = location.pathname.split('/');
      var nowpage = '<div class="' + nowPageHTML + '-->';
      axios.post('/api/articles/edit', {
        id: articleId[2],
        article: nowpage
      }).then(function (response) {
        alert('編集しました！！');
      })["catch"](function (response) {
        console.log(response);
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/footer-function.js":
/*!*****************************************!*\
  !*** ./resources/js/footer-function.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var foot = new Vue({
  el: '#footer-function',
  data: {
    switchFooterFunction: 0
  },
  methods: {
    // ハイライトと単語検索（とアクションなし）を切り替える
    // なんでfootの値をdictionaryインスタンスに渡せないんですか
    switchFooterFunctionHighlight: function switchFooterFunctionHighlight() {
      if (this.switchFooterFunction != 1) {
        this.switchFooterFunction = 1;
        dictionary.switchFooterFunction = 1;
      } else {
        this.switchFooterFunction = 0;
        dictionary.switchFooterFunction = 0;
      }
    },
    switchFooterFunctionDictionary: function switchFooterFunctionDictionary() {
      if (this.switchFooterFunction != 2) {
        this.switchFooterFunction = 2;
        dictionary.switchFooterFunction = 2;
      } else {
        this.switchFooterFunction = 0;
        dictionary.switchFooterFunction = 0;
      }
    },
    // 記事のインポート
    saveArticle: function saveArticle() {
      axios.post('/api/articles/import', {
        title: vm.articleTitle,
        // wikiの記事のaリンクを消す replaceは非破壊的メソッド
        article: vm.showArticleDetail.toString().replace(/<a[\s\S]*?>/g, '').replace(/<\/a>/g, ''),
        summary: vm.summary,
        status: 'wiki'
      }).then(function (response) {
        alert('インポートしました！！');
      })["catch"](function (error) {
        console.log(error);
      });
    }
  } // 記事のインポート

});

/***/ }),

/***/ "./resources/js/header-toggle.js":
/*!***************************************!*\
  !*** ./resources/js/header-toggle.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var head = new Vue({
  el: '#header',
  data: {
    toggle: false,

    /* 記事検索用データ */
    searchWord: '',
    searchResults: []
    /* 記事検索用データ */

  },
  // 記事検索用関数
  watch: {
    searchWord: function searchWord(newSearch) {
      var _this = this;

      this.searchResults = []; // queryの各パラメータを用いてwikiAPIを検索

      axios.get('/api/searchArticle/' + newSearch).then(function (response) {
        for (var i = 0; i < 8; i++) {
          // 検索結果から８つだけ取って配列に入れる
          if (_this.searchResults.length < 8) {
            _this.searchResults.push(response.data.query.search[i]);
          } else {
            _this.searchResults.shift();

            _this.searchResults.push(response.data.query.search[i]);
          }
        }
      })["catch"](function (response) {
        return console.log(response);
      });
    }
  },
  created: function created() {
    // サイズを変えるとthis.handleResizeでチェックするよう設定
    window.addEventListener('resize', this.handleResize); // ついでにページ開いた時にもthis.handleResizeする

    this.handleResize();
  },
  destroyed: function destroyed() {
    window.removeEventListener('resize', this.handleResize);
  },
  // 右上の三本線を押してメニューを出す関数
  methods: {
    handleResize: function handleResize() {
      // 750(三本線ライン)を越えるとtoggleがtrue（メニュー常に表示）になる
      if (window.innerWidth >= 750) {
        this.toggle = true;
      } else {
        this.toggle = false;
      }
    }
  }
});

/***/ }),

/***/ "./resources/js/showArticleDetail.js":
/*!*******************************************!*\
  !*** ./resources/js/showArticleDetail.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var vm = new Vue({
  el: '#showArticleDetail',
  data: {
    searchName: '',
    showArticleDetail: '',
    summary: '',
    // ハイライトの色
    nowHighlightColor: '#ff89ff',
    // 検索結果
    seeWord: '',
    articleTitle: '',
    seeWordsSampleText: '',
    translatedWord: ''
  },
  mounted: function mounted() {
    var _this = this;

    var pathname = location.pathname;
    this.searchName = pathname.split('/'); // スペースをアンダーバーに変えてエンコード

    var underVarJoin = this.searchName[2].split('%20').join('_');
    /* 記事本体の検索 */

    axios.get('/api/searchArticleDetail/' + underVarJoin).then(function (response) {
      _this.showArticleDetail = response.data.parse.text['*'].replace( //       wikiの記事で「File」（画像）を含まない
      /<a href="\/wiki\/((?!File:).*?)".*?>(.+?)<\/a>/g, // 新しいリンク
      // /ではなく./にしないと/searchArticleDetailが反映されない
      '<a href="./$1">$2</a>') // editと赤リンク（未編集)のリンクを消す
      .replace(/<a href="\/w\/index.*?".*?>(.*?)<\/a>/g, '$1') // helpのリンクがちゃんと貼れるようにする
      .replace(/<a href="((?=Help).*?)".*?>(.*?)<\/a>/g, '$2');
      _this.articleTitle = response.data.parse.title;
    })["catch"](function (response) {
      console.log(response);
    }); // 記事のsummaryの検索（記事保存の時にfooterに渡す）

    axios.get('/api/searchArticleSummary/' + underVarJoin).then(function (response) {
      var keyId = Object.keys(response.data.query.pages);
      _this.summary = response.data.query.pages[keyId].extract.replace(/<.+?>/g, '').slice(0, 180).concat('...');
    })["catch"](function (response) {
      return console.log(response);
    });
  },

  /* 記事本体の検索 */
  methods: {
    // ハイライト、単語検索の切り替え
    selected: function selected() {
      if (foot.switchFooterFunction == 1) {
        this.drowHighlight();
      }
    },
    clicked: function clicked() {
      if (foot.switchFooterFunction == 1) {
        this.deleteHighlight();
      } else if (foot.switchFooterFunction == 2) {
        this.searchWordMean();
      }
    },

    /* ハイライトを描く */
    drowHighlight: function drowHighlight() {
      // 現在青枠で囲んでいる範囲を取得して、その後Rangeオブジェクトを取得
      var selection = window.getSelection();
      var range = selection.getRangeAt(0); // HTML要素spanを生成

      var span = document.createElement('span'); // 色を指定

      span.style.backgroundColor = this.nowHighlightColor; // 範囲選択した要素をspanで囲む

      range.surroundContents(span);
    },

    /* ハイライトを描く */

    /* ハイライトを消す */
    deleteHighlight: function deleteHighlight() {
      var selection = window.getSelection(); // 選択した部分の最初のRangeオブジェクトを取得
      // 親ノード内の一番先頭のノード

      var startRange = selection.getRangeAt(0).startContainer; // ハイライトを消す関数を宣言

      var deleteHighlight = function deleteHighlight(child) {
        while (child) {
          // startRangeのノードがSPANだった場合処理実行、そうでなければ素通りして次のノードに
          if (child.nodeName == 'SPAN') {
            // 範囲指定した部分のテキストをtextノードにする
            var insertChild = document.createTextNode(child.textContent); // 親ノード取得

            var palent = child.parentNode; // textノードを新しく旧ノードの前に置く

            palent.insertBefore(insertChild, child); // 旧ノードを消す

            child.parentNode.removeChild(child);
          }

          child = child.previousSibling;
        }
      }; // 上記の関数だと一番後ろのノードまでハイライトがかかっている場合消せない


      var deleteHighlightEnd = function deleteHighlightEnd(child) {
        while (child) {
          if (child.nodeName == 'SPAN') {
            var insertChild = document.createTextNode(child.textContent);
            var palent = child.parentNode;
            palent.insertBefore(insertChild, child);
            child.parentNode.removeChild(child);
          } // 上の関数とは逆に終わったら前の子ノードへ行く


          child = child.nextSibling;
        }
      };

      deleteHighlight(startRange);
      deleteHighlightEnd(startRange);
    },

    /* ハイライトを消す */

    /* 単語の検索 */
    searchWordMean: function searchWordMean() {
      var selectWord = window.getSelection();
      /* 検索ワードが空であれば何もしない */

      if (selectWord.toString() !== '') {
        this.seeWord = selectWord.toString(); // ①selectWord.getRangeAt(0)（選択した言葉の）②.startContainer.parentNode（親ノードの）
        // ③textContent（テキストを抜き出す）

        var sampleText = selectWord.getRangeAt(0).startContainer.parentNode.textContent; // ピリオドで分割（英文ごとに区切る）

        var text = sampleText.split('.'); // text内の全ての文を調べ、検索ワードを含む文を抽出

        var matchText = '';

        for (var i = 0; i < text.length; i++) {
          if (text[i].indexOf(selectWord) >= 0) {
            matchText = text[i];
            break;
          }
        }

        this.seeWordsSampleText = matchText;
      } // dictionary.jsの関数を使用


      dictionary.searchWordMean(this.seeWord);
    }
  }
});

/***/ }),

/***/ "./resources/js/wordIndex.js":
/*!***********************************!*\
  !*** ./resources/js/wordIndex.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var head = new Vue({
  el: '#wordIndex',
  data: {
    // 登録単語の配列
    words: [],
    // toggle用
    showWordsProperty: []
  },
  mounted: function mounted() {
    this.indexWord();
  },
  methods: {
    indexWord: function indexWord() {
      var _this = this;

      var articleId = location.pathname.split('/');
      this.showWordsProperty = [];
      axios.get('/api/words/' + articleId[2]).then(function (response) {
        // リダイレクトはまずい
        _this.words = response.data;

        for (var i = 0; i < response.data.length; i++) {
          _this.showWordsProperty.push(0);
        }
      })["catch"](function (response) {
        console.log(response);
      });
    },
    deleteWord: function deleteWord(id) {
      var _this2 = this;

      axios["delete"]('/api/words/' + id).then(function (response) {
        _this2.indexWord();
      })["catch"](function (response) {
        return console.log(response);
      });
    },
    showSwitchMean: function showSwitchMean(index) {
      // ただ値を変えるだけでは再描画されないのでspliceを使う
      this.showWordsProperty.splice(index, 1, 0);
    },
    showSwitchSampleText: function showSwitchSampleText(index) {
      this.showWordsProperty.splice(index, 1, 1);
    }
  }
});

/***/ }),

/***/ "./resources/sass/main.scss":
/*!**********************************!*\
  !*** ./resources/sass/main.scss ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/wikipediaArticle.scss":
/*!**********************************************!*\
  !*** ./resources/sass/wikipediaArticle.scss ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/header-toggle.js ./resources/js/showArticleDetail.js ./resources/js/footer-function.js ./resources/js/footer-edit-function.js ./resources/js/dictionary.js ./resources/js/wordIndex.js ./resources/sass/main.scss ./resources/sass/wikipediaArticle.scss ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/fujisawakenyuu/sampleapp/laravel/wikieng/resources/js/header-toggle.js */"./resources/js/header-toggle.js");
__webpack_require__(/*! /Users/fujisawakenyuu/sampleapp/laravel/wikieng/resources/js/showArticleDetail.js */"./resources/js/showArticleDetail.js");
__webpack_require__(/*! /Users/fujisawakenyuu/sampleapp/laravel/wikieng/resources/js/footer-function.js */"./resources/js/footer-function.js");
__webpack_require__(/*! /Users/fujisawakenyuu/sampleapp/laravel/wikieng/resources/js/footer-edit-function.js */"./resources/js/footer-edit-function.js");
__webpack_require__(/*! /Users/fujisawakenyuu/sampleapp/laravel/wikieng/resources/js/dictionary.js */"./resources/js/dictionary.js");
__webpack_require__(/*! /Users/fujisawakenyuu/sampleapp/laravel/wikieng/resources/js/wordIndex.js */"./resources/js/wordIndex.js");
__webpack_require__(/*! /Users/fujisawakenyuu/sampleapp/laravel/wikieng/resources/sass/main.scss */"./resources/sass/main.scss");
module.exports = __webpack_require__(/*! /Users/fujisawakenyuu/sampleapp/laravel/wikieng/resources/sass/wikipediaArticle.scss */"./resources/sass/wikipediaArticle.scss");


/***/ })

/******/ });