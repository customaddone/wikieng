var vm = new Vue({
    el: 'header',

    data: {
        toggle: false,
        searchWord: ""
    },

    methods: {
        handleResize: function() {
            // 750(三本線ライン)を越えるとtoggleがtrue（メニュー常に表示）になる
            if (window.innerWidth >= 750) {
                this.toggle = true
            } else {
                this.toggle = false
            }
        }
    },

    created() {
        // サイズを変えるとthis.handleResizeでチェックするよう設定
        window.addEventListener('resize', this.handleResize)
        // ついでにページ開いた時にもthis.handleResizeする
        this.handleResize()
    },

    destroyed() {
        window.removeEventListener('resize', this.handleResize)
    }
})
