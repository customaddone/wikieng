@extends('layouts.layouts')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="explain">
        <h1 style="text-align: center;">アプリの使い方</h1>
        <br>

        <h2>１　使用可能な機能について</h2>

        <h2>　⑴　ログイン無しで利用可能な機能</h2>
        <p>　　・　Wikipedia記事の検索、閲覧</p>
        <p>　　・　ハイライト書き込み機能</p>
        <p>　　・　単語検索機能</p>

        <h2>　⑵　ログイン後に利用可能な機能</h2>
        <h2>　　　（右上の三本線を押してログイン画面からログインして下</h2>
        <h2>　　　さい。簡単ログインを押すと共有ユーザーでログインでき</h2>
        <h2>　　　ます）</h2>
        <p>　　上記プラス</p>
        <p>　　・　Wikipedia記事の保存</p>
        <p>　　・　ハイライト保存機能</p>
        <p>　　・　単語、例文保存機能</p>
        <br>

        <h2>２　各機能の使用方法について</h2>

        <h2>　⑴　Wikipedia記事の検索、閲覧</h2>
        <p>　　画面上の検索欄に検索ワードを記入すると検索結果が表示さ<p>
        <p>　　れるので、いずれかを押せばその記事を閲覧できます。</p>

        <h2>　⑵　ハイライト書き込み機能</h2>
        <p>　　画面下の「ハイライト」を押して下さい（右上に小枠が出ま<p>
        <p>　　す）。<p>
        <p>　　ア　PCの場合</p>
        <p>　　　　任意の文字を青枠で範囲指定し、画面の他の部分（なる
        <p>　　　　べく遠いところ）をクリックするとハイライトが表示さ</p>
        <p>　　　　れます。ハイライトの前後を押すとハイライトが消えま</p>
        <p>　　　　す。</p>
        <p>　　イ　スマホの場合</p>
        <p>　　　　任意の文字を青枠で範囲指定し、画面の他の部分をタッ</p>
        <p>　　　　チするとハイライトが表示されます。画面を長押しして</p>
        <p>　　　　ハイライトの前後で動かすとハイライトが消えます。</p>

        <h2>　⑶　単語検索機能</h2>
        <p>　　　画面下の「単語検索」を押して下さい（右上に小枠が出<p>
        <p>　　　ます）。任意の文字を青枠で範囲指定し、画面の他の部</p>
        <p>　　　分をタッチすると検索結果が右上に表示されます。<p>

        <h2>　⑷　Wikipedia記事の保存（ここから下はログイン後に使用</h2>
        <h2>　　　できる機能です。）</h2>
        <p>　　　画面下の「記事保存」を押して下さい。保存が完了すれば<p>
        <p>　　　「インポートしました！」と表示されます。保存した記事</p>
        <p>　　　は画面下の「MY記事」から閲覧できます。</p>

        <br>
        <img src="/images/searchByWord.jpeg" class="main-image"　width="300" height="200">
        <img src="/images/saveArticle.jpeg" class="main-image"　width="300" height="200">
        <p>　（緑丸の部分を押すと記事が「my記事」に保存されます。）<p>
        <p>　（保存した記事は青丸のところを押すと閲覧できます。）<p>
        <br>

        <h2>　⑸　ハイライト保存機能</h2>
        <p>　　　「MY記事」内の記事にハイライトを書き込み、画面下の<p>
        <p>　　　「記事保存」を押すとハイライトが保存されます。</p>

        <br>
        <img src="/images/highlight1.jpeg" class="main-image"　width="300" height="200">
        <img src="/images/highlight2.jpeg" class="main-image"　width="300" height="200">
        <p>　（ハイライト記入後、右下の記事保存」を押すとハイライトが保存されます。）<p>
        <p>　（「my記事」から再度記事を開いてもハイライトが残ったままになる。）<p>
        <br>

        <h2>　⑹　単語の意味、例文保存機能</h2>
        <p>　　　「MY記事」内の記事で単語を検索し、右上の小枠内を押<p>
        <p>　　　すと単語の意味と例文が保存されます。</p>
        <p>　　　保存した単語の意味、例文は右下の緑色のボタンを押すと</p>
        <p>　　　閲覧できます。</p>
        <p>　　　「意味」「例文」の文字を押すと切り替えができます</p>
        <br>
        <img src="/images/wordsearch.jpeg" class="main-image"　width="300" height="200">
        <img src="/images/wordindex1.jpeg" class="main-image"　width="300" height="200">
        <img src="/images/wordindex2.jpeg" class="main-image"　width="300" height="200">
        <p>　（検索した後、右上の小枠を押すと単語の意味が例文と一緒に保存されます。）<p>
        <p>　（保存した単語は右下の緑色のボタンを押すと閲覧できます。）<p>
        <br>
    </div>

    @component('components.footer')
    @endcomponent
@endsection
