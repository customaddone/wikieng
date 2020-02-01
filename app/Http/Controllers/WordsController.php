<?php

namespace App\Http\Controllers;

use App\Word;
use Illuminate\Http\Request;

class WordsController extends Controller
{
    public function show($articleId) {
        // getを忘れない
        $words = Word::where('article_id', '=', $articleId)->get();
        return view('words.wordIndex', ['words' => $words]);
    }

    public function create(Request $request) {
        $word = Word::create([
            'word' => $request->word,
            'mean' => $request->mean,
            'sampletext' => $request->sampletext,
            'article_id' => $request->article_id,
        ]);

        $word->save();
    }

    // APIでアクションを起こす
    public function destroy($id) {
        $word = Word::find($id);
        $word->delete();
        // redirectに引数つけないとhttpsに行かない
        return redirect('/myArticles', 302, [], true);
    }
}
