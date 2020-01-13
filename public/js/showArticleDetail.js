var vm = new Vue({
   el: '#showArticleDetail',

   data: {
     encodeSearchWord: "",
     showArticleDetail: ""
   },

   mounted: function () {
       var pathname= location.pathname;
       var searchname = pathname.split("/");
       // スペースをアンダーバーに変えてエンコード
       var underVarJoin = searchname[2].split("%20").join('_')
       this.encodeSearchWord = (searchname.length == 3) ? encodeURI(underVarJoin) : "";

       axios.get("/api/searchArticleDetail/" + this.encodeSearchWord)
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
    },
})
