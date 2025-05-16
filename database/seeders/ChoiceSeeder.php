<?php

namespace Database\Seeders;
use App\Models\Choice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Choice::insert([


            //EX 1
            ["question_id"=>"1","values"=>"have/do/get/take","is_correct"=>"have","created_at"=> now()],
            ["question_id"=>"1","values"=>"hold/keep/save/stay","is_correct"=>"hold","created_at"=> now()],
            ["question_id"=>"1","values"=>"searching/looking/seeking/gaining","is_correct"=>"seeking","created_at"=> now()],
            ["question_id"=>"1","values"=>"engage/combine/contribute/involve","is_correct"=>"engage","created_at"=> now()],
            ["question_id"=>"1","values"=>"motive/purpose/intention/cause","is_correct"=>"purpose","created_at"=> now()],
            ["question_id"=>"1","values"=>"excluding/except/apart/away","is_correct"=>"apart","created_at"=> now()],
            ["question_id"=>"1","values"=>"assets/profits/services/benefits","is_correct"=>"benefits","created_at"=> now()],
            ["question_id"=>"1","values"=>"plan/prepare/practise/provide","is_correct"=>"prepare","created_at"=> now()],
            ["question_id"=>"1","values"=>"brief/short/narrow/little","is_correct"=>"little","created_at"=> now()],

            //EX 2
            ["question_id"=>"2","values"=>"predictable/steady/repectable/main","is_correct"=>"predictable","created_at"=> now()],
            ["question_id"=>"2","values"=>"puzzle/trouble/obstacle/barrier","is_correct"=>"trouble","created_at"=> now()],
            ["question_id"=>"2","values"=>"touching/moving/walking/stepping","is_correct"=>"stepping","created_at"=> now()],
            ["question_id"=>"2","values"=>"worked/competed/stretched/struggled","is_correct"=>"struggled","created_at"=> now()],
            ["question_id"=>"2","values"=>"considered/thought/reflected/believed","is_correct"=>"considered","created_at"=> now()],
            ["question_id"=>"2","values"=>"making/finding/seeking/taking","is_correct"=>"taking","created_at"=> now()],
            ["question_id"=>"2","values"=>"look/search/sight/inquiry","is_correct"=>"search","created_at"=> now()],
            ["question_id"=>"2","values"=>"aimless/unreasonable/unreliable/indefinite","is_correct"=>"aimless","created_at"=> now()],
            ["question_id"=>"2","values"=>"difference/arrangement/variety/order","is_correct"=>"variety","created_at"=> now()],

            //EX 3
            ["question_id"=>"3","values"=>"inviting/attracting/involving/appealing","is_correct"=>"inviting","created_at"=> now()],
            ["question_id"=>"3","values"=>"set out/made up/brought out/come up","is_correct"=>"made up","created_at"=> now()],
            ["question_id"=>"3","values"=>"include/show/consist/appear","is_correct"=>"appear","created_at"=> now()],
            ["question_id"=>"3","values"=>"totally/widely/fully/vastly","is_correct"=>"widely","created_at"=> now()],
            ["question_id"=>"3","values"=>"consider/regard/prove/rate","is_correct"=>"consider","created_at"=> now()],
            ["question_id"=>"3","values"=>"state/tell/provide/inform","is_correct"=>"provide","created_at"=> now()],
            ["question_id"=>"3","values"=>"keep/rest/last/continue","is_correct"=>"continue","created_at"=> now()],
            ["question_id"=>"3","values"=>"familiar/aware/alert/experience","is_correct"=>"aware","created_at"=> now()],
            ["question_id"=>"3","values"=>"mark/copy/reflection/imitation","is_correct"=>"reflection","created_at"=> now()],

            //EX 4
            ["question_id"=>"4","values"=>"heart/key/bottom/focus","is_correct"=>"heart","created_at"=> now()],
            ["question_id"=>"4","values"=>"familiar/aware/informed/acquainted","is_correct"=>"aware","created_at"=> now()],
            ["question_id"=>"4","values"=>"view/suggestion/belief/idea","is_correct"=>"idea","created_at"=> now()],
            ["question_id"=>"4","values"=>"base/depend/do/make","is_correct"=>"base","created_at"=> now()],
            ["question_id"=>"4","values"=>"contains/involves/includes/consists","is_correct"=>"consists","created_at"=> now()],
            ["question_id"=>"4","values"=>"action/division/set/stage","is_correct"=>"stage","created_at"=> now()],
            ["question_id"=>"4","values"=>"seated/stocked/stored/sited","is_correct"=>"stored","created_at"=> now()],
            ["question_id"=>"4","values"=>"level/amount/extent/number","is_correct"=>"amount","created_at"=> now()],
            ["question_id"=>"4","values"=>"exact/single/one/isolated","is_correct"=>"single","created_at"=> now()],

            //EX 5
            ["question_id"=>"5","values"=>"making/taking/travelling/flying","is_correct"=>"taking","created_at"=> now()],
            ["question_id"=>"5","values"=>"leading/resulting/causing/creating","is_correct"=>"resulting","created_at"=> now()],
            ["question_id"=>"5","values"=>"pass/employ/use/spend","is_correct"=>"spend","created_at"=> now()],
            ["question_id"=>"5","values"=>"aware/thoughtful/wise/familiar","is_correct"=>"aware","created_at"=> now()],
            ["question_id"=>"5","values"=>"save/secure/guard/defend","is_correct"=>"save","created_at"=> now()],
            ["question_id"=>"5","values"=>"liked/popular/approved/accepted","is_correct"=>"popular","created_at"=> now()],
            ["question_id"=>"5","values"=>"used/experienced/preferred/prepared","is_correct"=>"used","created_at"=> now()],
            ["question_id"=>"5","values"=>"eager/keen/fond/enthusiastic","is_correct"=>"keen","created_at"=> now()],
            ["question_id"=>"5","values"=>"meet/know/join/make","is_correct"=>"make","created_at"=> now()],


            //-----------------------------------------------//
        ]);
    }
}
