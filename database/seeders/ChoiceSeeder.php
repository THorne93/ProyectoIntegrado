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


            ["question_id"=>"1","values"=>"have/do/get/take","is_correct"=>"have","created_at"=> now()],
            ["question_id"=>"1","values"=>"hold/keep/save/stay","is_correct"=>"hold","created_at"=> now()],
            ["question_id"=>"1","values"=>"searching/looking/seeking/gaining","is_correct"=>"seeking","created_at"=> now()],
            ["question_id"=>"1","values"=>"engage/combine/contribute/involve","is_correct"=>"engage","created_at"=> now()],
            ["question_id"=>"1","values"=>"motive/purpose/intention/cause","is_correct"=>"purpose","created_at"=> now()],
            ["question_id"=>"1","values"=>"excluding/except/apart/away","is_correct"=>"apart","created_at"=> now()],
            ["question_id"=>"1","values"=>"assets/profits/services/benefits","is_correct"=>"benefits","created_at"=> now()],
            ["question_id"=>"1","values"=>"plan/prepare/practise/provide","is_correct"=>"prepare","created_at"=> now()],
            ["question_id"=>"1","values"=>"brief/short/narrow/little","is_correct"=>"little","created_at"=> now()],


            //-----------------------------------------------//
        ]);
    }
}
