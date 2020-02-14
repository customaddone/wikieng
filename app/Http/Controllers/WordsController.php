<?php

namespace App\Http\Controllers;

use App\Word;
use Illuminate\Http\Request;
use App\Http\Requests\WordsValidateRequest;

class WordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($articleId) {
        return view('words.wordIndex', ['articleId' => $articleId]);
    }

    public function show($articleId) {
        // getを忘れない
        $words = Word::where('article_id', '=', $articleId)->get();
        return $words;
    }

    public function create(WordsValidateRequest $request) {
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
    }
}
