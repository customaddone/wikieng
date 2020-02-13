<?php

use Illuminate\Database\Seeder;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function InsertWordsSeeder($word, $mean) {
            DB::table('words')->insert([
                'word' => $word,
                'mean' => $mean,
                'sampletext' => 'This is a sample text',
                'article_id' => 1
            ]);
        }

        $word = 'web';
        $mean = '（クモなどが紡ぎ出す）『巣』	（クモの巣のような）網状組織；（張りめぐらした）仕掛け	（製織中の）織物 （アヒルなど水鳥の）水かき	（輪転機の）巻取り紙.';
        InsertWordsSeeder($word, $mean);

        $word = 'application';
        $mean = '〈Ｕ〉（…の…への）『適用』，応用《＋『ｏｆ』＋『名』＋『ｔｏ』＋『名』》	〈Ｕ〉〈Ｃ〉『申し込み』，志願；〈Ｃ〉願書	〈Ｕ〉（薬などを）塗ること，はること；〈Ｃ〉外用薬，化粧品	〈Ｕ〉（…に）心を傾けること，専心すること《＋『ｔｏ』＋『名』》.';
        InsertWordsSeeder($word, $mean);

        $word = 'framework';
        $mean = '（建物などの）骨組み；（…の）枠組《＋『ｏｆ』＋『名』》	（…の）構成；組織《＋『ｏｆ』＋『名』》.';
        InsertWordsSeeder($word, $mean);
    }
}
