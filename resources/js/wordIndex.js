var head = new Vue({
    el: '#wordIndex',

    data: {
        words: [],
    },

    mounted: function () {
        this.indexWord();
    },

    methods: {
        indexWord: function () {
            var articleId= location.pathname.split("/");

            axios.get("/api/words/" + articleId[2])
                 .then((response) => {
                     this.words = response.data;
                 })
                 .catch(response => console.log(response));
        },

        deleteWord: function (id) {
            axios.delete("/api/words/" + id)
                 .then((response) => {
                     this.indexWord();
                 }).catch(response => console.log(response));
        }
    }
})
