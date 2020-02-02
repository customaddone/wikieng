<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    // my記事に入ろうとするとログイン画面に飛ばされる
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        // idとタイトルだけgetする
        // idの前にはテーブルの名前をつける
       $articles = Article::where('user_id', '=', Auth::id())->select('id', 'title', 'summary')
           ->get();
       return view('articles.myArticles', [ 'articles' => $articles ]);
    }

    public function show($id) {
        $article = Article::find($id);
        return view('articles.myArticlesDetail', [ 'article' => $article ]);
    }

    public function destroy($id) {
        $article = Article::find($id);
        $article->delete();
        // redirectに引数つけないとhttpsに行かない
        return redirect('/myArticles');
    }

    // 記事の保存
    public function import(Request $request) {
        $article = Article::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'article' => $request->article,
            'summary' => $request->summary,
            'status' => $request->status
        ]);

        $article->save();
    }

    // 記事の編集
    public function edit(Request $request) {
        $article = Article::find($request->id);
        $article->article = $request->article;
        $article->save();
    }
}
