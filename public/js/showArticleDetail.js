var vm = new Vue({
   el: '#showArticleDetail',

   data: {
     searchName: "",
     showArticleDetail: "",
     summary: "",

     // ハイライトの色
     nowHighlightColor: "#ff89ff"
   },

   mounted: function () {
       var pathname= location.pathname;
       this.searchName = pathname.split("/");
       // スペースをアンダーバーに変えてエンコード
       var underVarJoin = this.searchName[2].split("%20").join('_')
       var encodeSearchWord = (this.searchName.length == 3) ? encodeURI(underVarJoin) : "";

       /* 記事本体の検索 */
       axios.get("/api/searchArticleDetail/" + encodeSearchWord)
            .then((response) => {

              　this.showArticleDetail = response.data.parse.text["*"]
              　
                .replace(
                //       wikiの記事で「File」（画像）を含まない
                /<a href="\/wiki\/((?!File:).*?)".*?>(.+?)<\/a>/g,
                // 新しいリンク
                // /ではなく./にしないと/searchArticleDetailが反映されない
                '<a href="./$1">$2</a>')
                // editと赤リンク（未編集)のリンクを消す
                .replace(
                /<a href="\/w\/index.*?".*?>(.*?)<\/a>/g,
                '$1'
                )
                // helpのリンクがちゃんと貼れるようにする
                .replace(
                /<a href="((?=Help).*?)".*?>(.*?)<\/a>/g,
                '$2'
                )
            })
            .catch(response => console.log(response));

        // 記事見出しの検索
        axios.get("/api/searchArticleSummary/" + encodeSearchWord)
             .then((response) => {
                  var keyId = Object.keys(response.data.query.pages)
                  this.summary = response.data.query.pages[keyId].extract
                                     .replace(/<.+?>/g, "")
                                     .slice(0, 120);
             })
        .catch(response => console.log(response));
    },
    /* 記事本体の検索 */

    methods: {
        /* ハイライトを描く */
        selected: function() {
            // 現在青枠で囲んでいる範囲を取得して、その後Rangeオブジェクトを取得
            var selection = window.getSelection();
            var range = selection.getRangeAt(0);
            // HTML要素spanを生成
            var span = document.createElement("span");
            // 色を指定
            span.style.backgroundColor = this.nowHighlightColor;
            // 範囲選択した要素をspanで囲む
            range.surroundContents(span);
        },
        /* ハイライトを描く */

        /* ハイライトを消す */
        clicked: function() {
            var selection = window.getSelection();
            // 選択した部分の最初のRangeオブジェクトを取得
            // 親ノード内の一番先頭のノード
            var startRange = selection.getRangeAt(0).startContainer;

            // ハイライトを消す関数を宣言
            var deleteHighlight = function (child) {
                while (child) {
                    // startRangeのノードがSPANだった場合処理実行、そうでなければ素通りして次のノードに
                    if (child.nodeName == "SPAN") {
                        // 範囲指定した部分のテキストをtextノードにする
                        var insertChild = document.createTextNode(child.textContent);
                        // 親ノード取得
                        var palent = child.parentNode;
                        // textノードを新しく旧ノードの前に置く
                        palent.insertBefore(insertChild, child);
                        // 旧ノードを消す
                        child.parentNode.removeChild(child);
                    }

                    child = child.previousSibling;
                }
            }

            // 上記の関数だと一番後ろのノードまでハイライトがかかっている場合消せない　
            var deleteHighlightEnd = function (child) {
                while (child) {
                    if (child.nodeName == "SPAN") {
                        var insertChild = document.createTextNode(child.textContent);
                        var palent = child.parentNode;
                        palent.insertBefore(insertChild, child);
                        child.parentNode.removeChild(child);
                    }

                    // 上の関数とは逆に終わったら前の子ノードへ行く
                    child = child.nextSibling;
                }
            }

            deleteHighlight(startRange)
            deleteHighlightEnd(startRange)
        }
        /* ハイライトを消す */
    }
})
