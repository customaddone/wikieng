var foot = new Vue({
    el: '#footer-function',

    // 記事のインポート
    methods: {
        saveArticle: function () {
            axios.post('/api/articles/import',{

                title: vm.searchName[2].toString(),

                // wikiの記事のaリンクを消す replaceは非破壊的メソッド
                article: vm.showArticleDetail
                           .toString()
                           .replace(/<a[\s\S]*?>/g, '')
                           .replace(/<\/a>/g, ''),

                summary: 'ace',
                status: 'wiki',

            }).then((response) => {
                alert('インポートしました！！')
            }).catch(function (error) {
                console.log(error);

            });
        },
    }
    // 記事のインポート
})
