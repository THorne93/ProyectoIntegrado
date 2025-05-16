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
            // these seeds will need to be rearranged -----> thankyou past me for doing this.
            // a bicycle you can fold up
            ["question_id" => "6", "hint" => "null", "value" => "been","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "can/may","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "so","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "with","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "not/hardly/scarcely","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "and","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "have","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "where","created_at"=> now()],
            ["question_id" => "6", "hint" => "null", "value" => "if","created_at"=> now()],

            // an irish cookery school
            ["question_id" => "7", "hint" => "null", "value" => "up","created_at"=> now()],
            ["question_id" => "7", "hint" => "null", "value" => "one","created_at"=> now()],
            ["question_id" => "7", "hint" => "null", "value" => "far","created_at"=> now()],
            ["question_id" => "7", "hint" => "null", "value" => "it","created_at"=> now()],
            ["question_id" => "7", "hint" => "null", "value" => "every/each","created_at"=> now()],
            ["question_id" => "7", "hint" => "null", "value" => "because","created_at"=> now()],
            ["question_id" => "7", "hint" => "null", "value" => "like","created_at"=> now()],
            ["question_id" => "7", "hint" => "null", "value" => "which/that","created_at"=> now()],
            ["question_id" => "7", "hint" => "null", "value" => "as","created_at"=> now()],

            //animal communication
            ["question_id" => "8", "hint" => "null", "value" => "is","created_at"=> now()],
            ["question_id" => "8", "hint" => "null", "value" => "one","created_at"=> now()],
            ["question_id" => "8", "hint" => "null", "value" => "as","created_at"=> now()],
            ["question_id" => "8", "hint" => "null", "value" => "what","created_at"=> now()],
            ["question_id" => "8", "hint" => "null", "value" => "of","created_at"=> now()],
            ["question_id" => "8", "hint" => "null", "value" => "in","created_at"=> now()],
            ["question_id" => "8", "hint" => "null", "value" => "been","created_at"=> now()],
            ["question_id" => "8", "hint" => "null", "value" => "order","created_at"=> now()],
            ["question_id" => "8", "hint" => "null", "value" => "amount","created_at"=> now()],

            //visit to a sweets factory
            ["question_id" => "9", "hint" => "null", "value" => "between","created_at"=> now()],
            ["question_id" => "9", "hint" => "null", "value" => "as/while","created_at"=> now()],
            ["question_id" => "9", "hint" => "null", "value" => "like","created_at"=> now()],
            ["question_id" => "9", "hint" => "null", "value" => "what","created_at"=> now()],
            ["question_id" => "9", "hint" => "null", "value" => "which/that","created_at"=> now()],
            ["question_id" => "9", "hint" => "null", "value" => "and","created_at"=> now()],
            ["question_id" => "9", "hint" => "null", "value" => "a","created_at"=> now()],
            ["question_id" => "9", "hint" => "null", "value" => "since","created_at"=> now()],
            ["question_id" => "9", "hint" => "null", "value" => "one","created_at"=> now()],

            // a short history of tattooing
            ["question_id" => "10", "hint" => "null", "value" => "which","created_at"=> now()],
            ["question_id" => "10", "hint" => "null", "value" => "spite","created_at"=> now()],
            ["question_id" => "10", "hint" => "null", "value" => "who/that","created_at"=> now()],
            ["question_id" => "10", "hint" => "null", "value" => "whose","created_at"=> now()],
            ["question_id" => "10", "hint" => "null", "value" => "order","created_at"=> now()],
            ["question_id" => "10", "hint" => "null", "value" => "owing/due","created_at"=> now()],
            ["question_id" => "10", "hint" => "null", "value" => "although/while/though/whereas","created_at"=> now()],
            ["question_id" => "10", "hint" => "null", "value" => "well","created_at"=> now()],
            ["question_id" => "10", "hint" => "null", "value" => "where","created_at"=> now()],






            // PART 3 SEEDS - likewise, order and question_id will need to be changed as more ex are added
            
            // TEA
            ["question_id" => "11", "hint" => "EXTREME", "value" => "extremely","created_at"=> now()],
            ["question_id" => "11", "hint" => "KNOW", "value" => "unknown","created_at"=> now()],
            ["question_id" => "11", "hint" => "REFER", "value" => "reference","created_at"=> now()],
            ["question_id" => "11", "hint" => "POPULAR", "value" => "popularity","created_at"=> now()],
            ["question_id" => "11", "hint" => "MARRY", "value" => "marriage","created_at"=> now()],
            ["question_id" => "11", "hint" => "FASHION", "value" => "fashionable","created_at"=> now()],
            ["question_id" => "11", "hint" => "ILL", "value" => "illnesses","created_at"=> now()],
            ["question_id" => "11", "hint" => "LABOUR", "value" => "laborers/labourers","created_at"=> now()],
            ["question_id" => "11", "hint" => "ENERGY", "value" => "energetic","created_at"=> now()],
            
            // RUNNING SPEED
            ["question_id" => "12", "hint" => "COMPETE", "value" => "competitors","created_at"=> now()],
            ["question_id" => "12", "hint" => "BELIEVE", "value" => "unbelievable","created_at"=> now()],
            ["question_id" => "12", "hint" => "CONSIDER", "value" => "considerably","created_at"=> now()],
            ["question_id" => "12", "hint" => "LIMIT", "value" => "limiting","created_at"=> now()],
            ["question_id" => "12", "hint" => "MINIMUM", "value" => "minimise/minimize","created_at"=> now()],
            ["question_id" => "12", "hint" => "IDENTITY", "value" => "identified","created_at"=> now()],
            ["question_id" => "12", "hint" => "EFFICIENCY", "value" => "efficient","created_at"=> now()],
            ["question_id" => "12", "hint" => "POSSIBLE", "value" => "possibility","created_at"=> now()],
            ["question_id" => "12", "hint" => "CHARACTER", "value" => "characteristics","created_at"=> now()],
            
            // CYCLING
            ["question_id" => "13", "hint" => "CYCLE", "value" => "cyclist","created_at"=> now()],
            ["question_id" => "13", "hint" => "POSSIBLE", "value" => "impossible","created_at"=> now()],
            ["question_id" => "13", "hint" => "EXHAUST", "value" => "exhausting","created_at"=> now()],
            ["question_id" => "13", "hint" => "BREATH", "value" => "breathless","created_at"=> now()],
            ["question_id" => "13", "hint" => "MARVEL", "value" => "marvellous","created_at"=> now()],
            ["question_id" => "13", "hint" => "ENJOY", "value" => "enjoyable","created_at"=> now()],
            ["question_id" => "13", "hint" => "LIKE", "value" => "unlike","created_at"=> now()],
            ["question_id" => "13", "hint" => "PLEASE", "value" => "pleasure","created_at"=> now()],
            ["question_id" => "13", "hint" => "EQUAL", "value" => "equally","created_at"=> now()],
            
            // JOB INTERVIEWS
            ["question_id" => "14", "hint" => "NERVE", "value" => "nervous","created_at"=> now()],
            ["question_id" => "14", "hint" => "OBJECT", "value" => "objective","created_at"=> now()],
            ["question_id" => "14", "hint" => "DESCRIBE", "value" => "description","created_at"=> now()],
            ["question_id" => "14", "hint" => "DECIDE", "value" => "decisions","created_at"=> now()],
            ["question_id" => "14", "hint" => "PERSON", "value" => "personality","created_at"=> now()],
            ["question_id" => "14", "hint" => "CONSCIOUS", "value" => "unconsciously","created_at"=> now()],
            ["question_id" => "14", "hint" => "EASY", "value" => "ease","created_at"=> now()],
            ["question_id" => "14", "hint" => "VARY", "value" => "variety","created_at"=> now()],
            ["question_id" => "14", "hint" => "ENTHUSIASM", "value" => "enthusiastic","created_at"=> now()],
            
            // BRAIN GAMES
            ["question_id" => "15", "hint" => "HEALTH", "value" => "healthy","created_at"=> now()],
            ["question_id" => "15", "hint" => "SATISFY", "value" => "satisfaction","created_at"=> now()],
            ["question_id" => "15", "hint" => "SUCCESS", "value" => "successful","created_at"=> now()],
            ["question_id" => "15", "hint" => "COVER", "value" => "discover","created_at"=> now()],
            ["question_id" => "15", "hint" => "SOLVE", "value" => "solutions","created_at"=> now()],
            ["question_id" => "15", "hint" => "IMPROVE", "value" => "improvement","created_at"=> now()],
            ["question_id" => "15", "hint" => "SCIENCE", "value" => "scientists","created_at"=> now()],
            ["question_id" => "15", "hint" => "PERFORM", "value" => "performance","created_at"=> now()],
            ["question_id" => "15", "hint" => "CERTAIN", "value" => "uncertain","created_at"=> now()],



            // PART 4

            //ex 1
            ["question_id"=>"16","hint"=>"FEW","value"=>"few programmes | were sold","created_at"=> now()],
            ["question_id"=>"17","hint"=>"INSTEAD","value"=>"instead of | taking/catching/getting","created_at"=> now()],
            ["question_id"=>"18","hint"=>"NEVER","value"=>"had/'d never | broken","created_at"=> now()],
            ["question_id"=>"19","hint"=>"LOOK","value"=>"would | look into/at","created_at"=> now()],
            ["question_id"=>"20","hint"=>"BECAUSE","value"=>"was/got postponed | because it rained","created_at"=> now()],
            ["question_id"=>"21","hint"=>"CARRY","value"=>"to carry on | working","created_at"=> now()],
            
            //ex 2
            ["question_id"=>"22","hint"=>"FIRST","value"=>"was|the first time (that)","created_at"=> now()],
            ["question_id"=>"23","hint"=>"NOT","value"=>"could not|have","created_at"=> now()],
            ["question_id"=>"24","hint"=>"INCREASE","value"=>"has been|no increase","created_at"=> now()],
            ["question_id"=>"25","hint"=>"BIG","value"=>"is not/isn't big|enough to","created_at"=> now()],
            ["question_id"=>"26","hint"=>"AVOID","value"=>"(that) he would/could avoid|spilling","created_at"=> now()],
            ["question_id"=>"27","hint"=>"PREVENTED","value"=>"prevented me (from) /my|getting","created_at"=> now()],
            
            //ex 3
            ["question_id"=>"28","hint"=>"BETTER","value"=>"play tennis|better than he","created_at"=> now()],
            ["question_id"=>"29","hint"=>"BOUGHT","value"=>"are/us|(being) bought from","created_at"=> now()],
            ["question_id"=>"30","hint"=>"PRAISED","value"=>"was praised|by the coach","created_at"=> now()],
            ["question_id"=>"31","hint"=>"TOUCH","value"=>"to get|in touch with","created_at"=> now()],
            ["question_id"=>"32","hint"=>"SALE","value"=>"be|on/for sale before","created_at"=> now()],
            ["question_id"=>"33","hint"=>"BEEN","value"=>"if|it had not been","created_at"=> now()],
            
            //ex 4
            ["question_id"=>"34","hint"=>"MUCH","value"=>"how much|the trips","created_at"=> now()],
            ["question_id"=>"35","hint"=>"COME","value"=>"able to|come up with","created_at"=> now()],
            ["question_id"=>"36","hint"=>"GIVE","value"=>"to give|(careful) thought/consideration to","created_at"=> now()],
            ["question_id"=>"37","hint"=>"EVEN","value"=>"on (walking)|even when/though/after it","created_at"=> now()],
            ["question_id"=>"38","hint"=>"HARDLY","value"=>"hardly any tickets|left/remaining/(still) available","created_at"=> now()],
            ["question_id"=>"39","hint"=>"CHANCE","value"=>"a/any chance|of getting","created_at"=> now()],
            
            //ex 5
            ["question_id"=>"40","hint"=>"REMEMBER","value"=>"will always remember|going","created_at"=> now()],
            ["question_id"=>"41","hint"=>"SHOULD","value"=>"should not|have ridden","created_at"=> now()],
            ["question_id"=>"42","hint"=>"WORTH","value"=>"it wasn't|worth staying","created_at"=> now()],
            ["question_id"=>"43","hint"=>"MIGHT","value"=>"might have|hidden","created_at"=> now()],
            ["question_id"=>"44","hint"=>"CARRIED","value"=>"carried on|going up","created_at"=> now()],
            ["question_id"=>"45","hint"=>"LIKELY","value"=>"isn't likely|to improve","created_at"=> now()],
        ]);
    }
}
