<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index() {
        // idとタイトルだけgetする
        // idの前にはテーブルの名前をつける
       $articles = Article::select('id', 'title', 'summary')
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
        return redirect('/myArticles');
    }

    // 記事の保存
    public function import(Request $request) {
        $article = Article::create([
            'title' => $request->title,
            'article' => $request->article,
            'summary' => $request->summary,
            'status' => $request->status
        ]);

        $article->save();
    }
}
