var vm = new Vue({
   el: '#showArticleDetail',

   data: {
     searchName: "",
     showArticleDetail: "",
     summary: ""
   },

   mounted: function () {
       var pathname= location.pathname;
       this.searchName = pathname.split("/");
       // スペースをアンダーバーに変えてエンコード
       var underVarJoin = this.searchName[2].split("%20").join('_')
       var encodeSearchWord = (this.searchName.length == 3) ? encodeURI(underVarJoin) : "";

       // 記事本体の検索
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
})
