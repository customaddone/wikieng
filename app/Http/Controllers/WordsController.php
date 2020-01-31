<?php

namespace App\Http\Controllers;

use App\Word;
use Illuminate\Http\Request;

class WordsController extends Controller
{
    // 単語の保存
    public function create(Request $request) {
        $article = Word::create([
            'word' => $request->word,
            'mean' => $request->mean,
            'sampletext' => $request->sampletext,
            'article_id' => $request->article_id,
        ]);

        $article->save();
    }
}
