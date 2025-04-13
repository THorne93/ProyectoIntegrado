<?php

namespace Database\Seeders;
use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Answer::insert([

            // Per part 2 exercise, there are 9 answers. Depending on database seeder order,
            // these seeds will need to be rearranged
            // a bicycle you can fold up
            ["question_id" => "2", "hint" => "null", "value" => "been","created_at"=> now()],
            ["question_id" => "2", "hint" => "null", "value" => "can/may","created_at"=> now()],
            ["question_id" => "2", "hint" => "null", "value" => "so","created_at"=> now()],
            ["question_id" => "2", "hint" => "null", "value" => "with","created_at"=> now()],
            ["question_id" => "2", "hint" => "null", "value" => "not/hardly/scarcely","created_at"=> now()],
            ["question_id" => "2", "hint" => "null", "value" => "and","created_at"=> now()],
            ["question_id" => "2", "hint" => "null", "value" => "have","created_at"=> now()],
            ["question_id" => "2", "hint" => "null", "value" => "where","created_at"=> now()],
            ["question_id" => "2", "hint" => "null", "value" => "if","created_at"=> now()],

            // an irish cookery school
            ["question_id" => "3", "hint" => "null", "value" => "up","created_at"=> now()],
            ["question_id" => "3", "hint" => "null", "value" => "one","created_at"=> now()],
            ["question_id" => "3", "hint" => "null", "value" => "far","created_at"=> now()],
            ["question_id" => "3", "hint" => "null", "value" => "it","created_at"=> now()],
            ["question_id" => "3", "hint" => "null", "value" => "every/each","created_at"=> now()],
            ["question_id" => "3", "hint" => "null", "value" => "because","created_at"=> now()],
            ["question_id" => "3", "hint" => "null", "value" => "like","created_at"=> now()],
            ["question_id" => "3", "hint" => "null", "value" => "which/that","created_at"=> now()],
            ["question_id" => "3", "hint" => "null", "value" => "as","created_at"=> now()],

            //animal communication
            ["question_id" => "4", "hint" => "null", "value" => "is","created_at"=> now()],
            ["question_id" => "4", "hint" => "null", "value" => "one","created_at"=> now()],
            ["question_id" => "4", "hint" => "null", "value" => "as","created_at"=> now()],
            ["question_id" => "4", "hint" => "null", "value" => "what","created_at"=> now()],
            ["question_id" => "4", "hint" => "null", "value" => "of","created_at"=> now()],
            ["question_id" => "4", "hint" => "null", "value" => "in","created_at"=> now()],
            ["question_id" => "4", "hint" => "null", "value" => "been","created_at"=> now()],
            ["question_id" => "4", "hint" => "null", "value" => "order","created_at"=> now()],
            ["question_id" => "4", "hint" => "null", "value" => "amount","created_at"=> now()],

            //visit to a sweets factory
            ["question_id" => "5", "hint" => "null", "value" => "between","created_at"=> now()],
            ["question_id" => "5", "hint" => "null", "value" => "as/while","created_at"=> now()],
            ["question_id" => "5", "hint" => "null", "value" => "like","created_at"=> now()],
            ["question_id" => "5", "hint" => "null", "value" => "what","created_at"=> now()],
            ["question_id" => "5", "hint" => "null", "value" => "which/that","created_at"=> now()],
            ["question_id" => "5", "hint" => "null", "value" => "and","created_at"=> now()],
            ["question_id" => "5", "hint" => "null", "value" => "a","created_at"=> now()],
            ["question_id" => "5", "hint" => "null", "value" => "since","created_at"=> now()],
            ["question_id" => "5", "hint" => "null", "value" => "one","created_at"=> now()],

            // a short history of tattooing
            ["question_id" => "6", "hint" => "null", "value" => "which","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "spite","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "who/that","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "whose","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "order","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "owing/due","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "although/while/though/whereas","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "well","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "where","created_at"=> now()],






            // PART 3 SEEDS - likewise, order and question_id will need to be changed as more ex are added

            ["question_id" => "7", "hint" => "EXTREME", "value" => "extremely","created_at"=> now()],
            ["question_id" => "7", "hint" => "KNOW", "value" => "unknown","created_at"=> now()],
            ["question_id" => "7", "hint" => "REFER", "value" => "reference","created_at"=> now()],
            ["question_id" => "7", "hint" => "POPULAR", "value" => "popularity","created_at"=> now()],
            ["question_id" => "7", "hint" => "MARRY", "value" => "marriage","created_at"=> now()],
            ["question_id" => "7", "hint" => "FASHION", "value" => "fashionable","created_at"=> now()],
            ["question_id" => "7", "hint" => "ILL", "value" => "illnesses","created_at"=> now()],
            ["question_id" => "7", "hint" => "LABOUR", "value" => "laborers/labourers","created_at"=> now()],
            ["question_id" => "7", "hint" => "ENERGY", "value" => "energetic","created_at"=> now()],



            // PART 4

            ["question_id"=>"8","hint"=>"FEW","value"=>"few programmes | were sold","created_at"=> now()],
            ["question_id"=>"9","hint"=>"INSTEAD","value"=>"instead of | taking/catching/getting","created_at"=> now()],
            ["question_id"=>"10","hint"=>"NEVER","value"=>"had/'d never | broken","created_at"=> now()],
            ["question_id"=>"11","hint"=>"LOOK","value"=>"would | look into/at","created_at"=> now()],
            ["question_id"=>"12","hint"=>"BECAUSE","value"=>"was/got postponed | because it rained","created_at"=> now()],
            ["question_id"=>"13","hint"=>"CARRY","value"=>"to carry on | working","created_at"=> now()]
        ]);
    }
}
