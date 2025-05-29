<?php

namespace Database\Seeders;
use App\Models\Answer;
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
            ["question_id" => "6", "hint" => "null", "value" => "been", "created_at" => now()],
            ["question_id" => "6", "hint" => "null", "value" => "can/may", "created_at" => now()],
            ["question_id" => "6", "hint" => "null", "value" => "so", "created_at" => now()],
            ["question_id" => "6", "hint" => "null", "value" => "with", "created_at" => now()],
            ["question_id" => "6", "hint" => "null", "value" => "not/hardly/scarcely", "created_at" => now()],
            ["question_id" => "6", "hint" => "null", "value" => "and", "created_at" => now()],
            ["question_id" => "6", "hint" => "null", "value" => "have", "created_at" => now()],
            ["question_id" => "6", "hint" => "null", "value" => "where", "created_at" => now()],
            ["question_id" => "6", "hint" => "null", "value" => "if", "created_at" => now()],

            // an irish cookery school
            ["question_id" => "7", "hint" => "null", "value" => "up", "created_at" => now()],
            ["question_id" => "7", "hint" => "null", "value" => "one", "created_at" => now()],
            ["question_id" => "7", "hint" => "null", "value" => "far", "created_at" => now()],
            ["question_id" => "7", "hint" => "null", "value" => "it", "created_at" => now()],
            ["question_id" => "7", "hint" => "null", "value" => "every/each", "created_at" => now()],
            ["question_id" => "7", "hint" => "null", "value" => "because", "created_at" => now()],
            ["question_id" => "7", "hint" => "null", "value" => "like", "created_at" => now()],
            ["question_id" => "7", "hint" => "null", "value" => "which/that", "created_at" => now()],
            ["question_id" => "7", "hint" => "null", "value" => "as", "created_at" => now()],

            //animal communication
            ["question_id" => "8", "hint" => "null", "value" => "is", "created_at" => now()],
            ["question_id" => "8", "hint" => "null", "value" => "one", "created_at" => now()],
            ["question_id" => "8", "hint" => "null", "value" => "as", "created_at" => now()],
            ["question_id" => "8", "hint" => "null", "value" => "what", "created_at" => now()],
            ["question_id" => "8", "hint" => "null", "value" => "of", "created_at" => now()],
            ["question_id" => "8", "hint" => "null", "value" => "in", "created_at" => now()],
            ["question_id" => "8", "hint" => "null", "value" => "been", "created_at" => now()],
            ["question_id" => "8", "hint" => "null", "value" => "order", "created_at" => now()],
            ["question_id" => "8", "hint" => "null", "value" => "amount", "created_at" => now()],

            //visit to a sweets factory
            ["question_id" => "9", "hint" => "null", "value" => "between", "created_at" => now()],
            ["question_id" => "9", "hint" => "null", "value" => "as/while", "created_at" => now()],
            ["question_id" => "9", "hint" => "null", "value" => "like", "created_at" => now()],
            ["question_id" => "9", "hint" => "null", "value" => "what", "created_at" => now()],
            ["question_id" => "9", "hint" => "null", "value" => "which/that", "created_at" => now()],
            ["question_id" => "9", "hint" => "null", "value" => "and", "created_at" => now()],
            ["question_id" => "9", "hint" => "null", "value" => "a", "created_at" => now()],
            ["question_id" => "9", "hint" => "null", "value" => "since", "created_at" => now()],
            ["question_id" => "9", "hint" => "null", "value" => "one", "created_at" => now()],

            // a short history of tattooing
            ["question_id" => "10", "hint" => "null", "value" => "which", "created_at" => now()],
            ["question_id" => "10", "hint" => "null", "value" => "spite", "created_at" => now()],
            ["question_id" => "10", "hint" => "null", "value" => "who/that", "created_at" => now()],
            ["question_id" => "10", "hint" => "null", "value" => "whose", "created_at" => now()],
            ["question_id" => "10", "hint" => "null", "value" => "order", "created_at" => now()],
            ["question_id" => "10", "hint" => "null", "value" => "owing/due", "created_at" => now()],
            ["question_id" => "10", "hint" => "null", "value" => "although/while/though/whereas", "created_at" => now()],
            ["question_id" => "10", "hint" => "null", "value" => "well", "created_at" => now()],
            ["question_id" => "10", "hint" => "null", "value" => "where", "created_at" => now()],






            // PART 3 SEEDS - likewise, order and question_id will need to be changed as more ex are added

            // TEA
            ["question_id" => "11", "hint" => "EXTREME", "value" => "extremely", "created_at" => now()],
            ["question_id" => "11", "hint" => "KNOW", "value" => "unknown", "created_at" => now()],
            ["question_id" => "11", "hint" => "REFER", "value" => "reference", "created_at" => now()],
            ["question_id" => "11", "hint" => "POPULAR", "value" => "popularity", "created_at" => now()],
            ["question_id" => "11", "hint" => "MARRY", "value" => "marriage", "created_at" => now()],
            ["question_id" => "11", "hint" => "FASHION", "value" => "fashionable", "created_at" => now()],
            ["question_id" => "11", "hint" => "ILL", "value" => "illnesses", "created_at" => now()],
            ["question_id" => "11", "hint" => "LABOUR", "value" => "laborers/labourers", "created_at" => now()],
            ["question_id" => "11", "hint" => "ENERGY", "value" => "energetic", "created_at" => now()],

            // RUNNING SPEED
            ["question_id" => "12", "hint" => "COMPETE", "value" => "competitors", "created_at" => now()],
            ["question_id" => "12", "hint" => "BELIEVE", "value" => "unbelievable", "created_at" => now()],
            ["question_id" => "12", "hint" => "CONSIDER", "value" => "considerably", "created_at" => now()],
            ["question_id" => "12", "hint" => "LIMIT", "value" => "limiting", "created_at" => now()],
            ["question_id" => "12", "hint" => "MINIMUM", "value" => "minimise/minimize", "created_at" => now()],
            ["question_id" => "12", "hint" => "IDENTITY", "value" => "identified", "created_at" => now()],
            ["question_id" => "12", "hint" => "EFFICIENCY", "value" => "efficient", "created_at" => now()],
            ["question_id" => "12", "hint" => "POSSIBLE", "value" => "possibility", "created_at" => now()],
            ["question_id" => "12", "hint" => "CHARACTER", "value" => "characteristics", "created_at" => now()],

            // CYCLING
            ["question_id" => "13", "hint" => "CYCLE", "value" => "cyclist", "created_at" => now()],
            ["question_id" => "13", "hint" => "POSSIBLE", "value" => "impossible", "created_at" => now()],
            ["question_id" => "13", "hint" => "EXHAUST", "value" => "exhausting", "created_at" => now()],
            ["question_id" => "13", "hint" => "BREATH", "value" => "breathless", "created_at" => now()],
            ["question_id" => "13", "hint" => "MARVEL", "value" => "marvellous", "created_at" => now()],
            ["question_id" => "13", "hint" => "ENJOY", "value" => "enjoyable", "created_at" => now()],
            ["question_id" => "13", "hint" => "LIKE", "value" => "unlike", "created_at" => now()],
            ["question_id" => "13", "hint" => "PLEASE", "value" => "pleasure", "created_at" => now()],
            ["question_id" => "13", "hint" => "EQUAL", "value" => "equally", "created_at" => now()],

            // JOB INTERVIEWS
            ["question_id" => "14", "hint" => "NERVE", "value" => "nervous", "created_at" => now()],
            ["question_id" => "14", "hint" => "OBJECT", "value" => "objective", "created_at" => now()],
            ["question_id" => "14", "hint" => "DESCRIBE", "value" => "description", "created_at" => now()],
            ["question_id" => "14", "hint" => "DECIDE", "value" => "decisions", "created_at" => now()],
            ["question_id" => "14", "hint" => "PERSON", "value" => "personality", "created_at" => now()],
            ["question_id" => "14", "hint" => "CONSCIOUS", "value" => "unconsciously", "created_at" => now()],
            ["question_id" => "14", "hint" => "EASY", "value" => "ease", "created_at" => now()],
            ["question_id" => "14", "hint" => "VARY", "value" => "variety", "created_at" => now()],
            ["question_id" => "14", "hint" => "ENTHUSIASM", "value" => "enthusiastic", "created_at" => now()],

            // BRAIN GAMES
            ["question_id" => "15", "hint" => "HEALTH", "value" => "healthy", "created_at" => now()],
            ["question_id" => "15", "hint" => "SATISFY", "value" => "satisfaction", "created_at" => now()],
            ["question_id" => "15", "hint" => "SUCCESS", "value" => "successful", "created_at" => now()],
            ["question_id" => "15", "hint" => "COVER", "value" => "discover", "created_at" => now()],
            ["question_id" => "15", "hint" => "SOLVE", "value" => "solutions", "created_at" => now()],
            ["question_id" => "15", "hint" => "IMPROVE", "value" => "improvement", "created_at" => now()],
            ["question_id" => "15", "hint" => "SCIENCE", "value" => "scientists", "created_at" => now()],
            ["question_id" => "15", "hint" => "PERFORM", "value" => "performance", "created_at" => now()],
            ["question_id" => "15", "hint" => "CERTAIN", "value" => "uncertain", "created_at" => now()],



            // PART 4

            //ex 1
            ["question_id" => "16", "hint" => "FEW", "value" => json_encode(["few programmes | were sold"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => 17, "hint" => "INSTEAD", "value" => json_encode(["instead of|taking/catching/getting"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => 18, "hint" => "NEVER", "value" => json_encode(["had/'d never|broken"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => 19, "hint" => "LOOK", "value" => json_encode(["would|look into/at"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => 20, "hint" => "BECAUSE", "value" => json_encode(["was/got postponed|because it rained"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => 21, "hint" => "CARRY", "value" => json_encode(["to carry on|working"], JSON_UNESCAPED_SLASHES), "created_at" => now()],



            //ex 2
            ["question_id" => "22", "hint" => "FIRST", "value" => json_encode(["was|the first time (that)"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "23", "hint" => "NOT", "value" => json_encode(["could not|have"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "24", "hint" => "INCREASE", "value" => json_encode(["has been|no increase", "has not been|any/an increase", "hasn't been|any/an increase"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "25", "hint" => "BIG", "value" => json_encode(["is not/isn't big|enough to"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "26", "hint" => "AVOID", "value" => json_encode(["(that) he would/could avoid|spilling", "as to avoid|spilling"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "27", "hint" => "PREVENTED", "value" => json_encode(["prevented me (from) /my|getting"], JSON_UNESCAPED_SLASHES), "created_at" => now()],


            //ex 3
            ["question_id" => "28", "hint" => "BETTER", "value" => json_encode(["play tennis|better than he"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "29", "hint" => "BOUGHT", "value" => json_encode(["are/us|(being) bought from"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "30", "hint" => "PRAISED", "value" => json_encode(["was praised|by the coach"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "31", "hint" => "TOUCH", "value" => json_encode(["to get|in touch with"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "32", "hint" => "SALE", "value" => json_encode(["be|on/for sale before"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "33", "hint" => "BEEN", "value" => json_encode(["if|it had not been"], JSON_UNESCAPED_SLASHES), "created_at" => now()],


            //ex 4
            ["question_id" => "34", "hint" => "MUCH", "value" => json_encode(["how much|the trips"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "35", "hint" => "COME", "value" => json_encode(["able to|come up with"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "36", "hint" => "GIVE", "value" => json_encode(["to give|(careful) thought/consideration to"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "37", "hint" => "EVEN", "value" => json_encode(["on (walking)|even when/though/after it"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "38", "hint" => "HARDLY", "value" => json_encode(["hardly any tickets|left/remaining/(still) available"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "39", "hint" => "CHANCE", "value" => json_encode(["a/any chance|of getting"], JSON_UNESCAPED_SLASHES), "created_at" => now()],


            //ex 5
            ["question_id" => "40", "hint" => "REMEMBER", "value" => json_encode(["will always remember|going"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "41", "hint" => "SHOULD", "value" => json_encode(["should not|have ridden"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "42", "hint" => "WORTH", "value" => json_encode(["it wasn't|worth staying"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "43", "hint" => "MIGHT", "value" => json_encode(["might have|hidden"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "44", "hint" => "CARRIED", "value" => json_encode(["carried on|going up"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "45", "hint" => "LIKELY", "value" => json_encode(["isn't likely|to improve"], JSON_UNESCAPED_SLASHES), "created_at" => now()],


            //NEW ANSWERS
            ["question_id" => "51", "hint" => "null", "value" => "in", "created_at" => now()],
            ["question_id" => "51", "hint" => "null", "value" => "up", "created_at" => now()],
            ["question_id" => "51", "hint" => "null", "value" => "something", "created_at" => now()],
            ["question_id" => "51", "hint" => "null", "value" => "was", "created_at" => now()],
            ["question_id" => "51", "hint" => "null", "value" => "which/that", "created_at" => now()],
            ["question_id" => "51", "hint" => "null", "value" => "on", "created_at" => now()],
            ["question_id" => "51", "hint" => "null", "value" => "few", "created_at" => now()],
            ["question_id" => "51", "hint" => "null", "value" => "the", "created_at" => now()],
            ["question_id" => "51", "hint" => "null", "value" => "rather", "created_at" => now()],

            ["question_id" => "52", "hint" => "null", "value" => "in", "created_at" => now()],
            ["question_id" => "52", "hint" => "null", "value" => "well", "created_at" => now()],
            ["question_id" => "52", "hint" => "null", "value" => "With/In", "created_at" => now()],
            ["question_id" => "52", "hint" => "null", "value" => "which/that", "created_at" => now()],
            ["question_id" => "52", "hint" => "null", "value" => "get", "created_at" => now()],
            ["question_id" => "52", "hint" => "null", "value" => "either", "created_at" => now()],
            ["question_id" => "52", "hint" => "null", "value" => "this/that", "created_at" => now()],
            ["question_id" => "52", "hint" => "null", "value" => "account", "created_at" => now()],
            ["question_id" => "52", "hint" => "null", "value" => "Althouth/Though", "created_at" => now()],

            ["question_id" => "53", "hint" => "null", "value" => "go", "created_at" => now()],
            ["question_id" => "53", "hint" => "null", "value" => "into", "created_at" => now()],
            ["question_id" => "53", "hint" => "null", "value" => "in", "created_at" => now()],
            ["question_id" => "53", "hint" => "null", "value" => "of/about", "created_at" => now()],
            ["question_id" => "53", "hint" => "null", "value" => "where", "created_at" => now()],
            ["question_id" => "53", "hint" => "null", "value" => "order", "created_at" => now()],
            ["question_id" => "53", "hint" => "null", "value" => "not", "created_at" => now()],
            ["question_id" => "53", "hint" => "null", "value" => "out", "created_at" => now()],
            ["question_id" => "53", "hint" => "null", "value" => "the", "created_at" => now()],


            ["question_id" => "54", "hint" => "null", "value" => "in", "created_at" => now()],
            ["question_id" => "54", "hint" => "null", "value" => "matter", "created_at" => now()],
            ["question_id" => "54", "hint" => "null", "value" => "must", "created_at" => now()],
            ["question_id" => "54", "hint" => "null", "value" => "of", "created_at" => now()],
            ["question_id" => "54", "hint" => "null", "value" => "were", "created_at" => now()],
            ["question_id" => "54", "hint" => "null", "value" => "apart", "created_at" => now()],
            ["question_id" => "54", "hint" => "null", "value" => "how", "created_at" => now()],
            ["question_id" => "54", "hint" => "null", "value" => "at", "created_at" => now()],
            ["question_id" => "54", "hint" => "null", "value" => "would", "created_at" => now()],

            ["question_id" => "55", "hint" => "null", "value" => "one", "created_at" => now()],
            ["question_id" => "55", "hint" => "null", "value" => "as", "created_at" => now()],
            ["question_id" => "55", "hint" => "null", "value" => "which", "created_at" => now()],
            ["question_id" => "55", "hint" => "null", "value" => "whole", "created_at" => now()],
            ["question_id" => "55", "hint" => "null", "value" => "like", "created_at" => now()],
            ["question_id" => "55", "hint" => "null", "value" => "If/Should", "created_at" => now()],
            ["question_id" => "55", "hint" => "null", "value" => "spite", "created_at" => now()],
            ["question_id" => "55", "hint" => "null", "value" => "make", "created_at" => now()],
            ["question_id" => "55", "hint" => "null", "value" => "unless", "created_at" => now()],

            ["question_id" => "56", "hint" => "AMERICA", "value" => "american", "created_at" => now()],
            ["question_id" => "56", "hint" => "INHABIT", "value" => "inhabitants", "created_at" => now()],
            ["question_id" => "56", "hint" => "VISIT", "value" => "visitors", "created_at" => now()],
            ["question_id" => "56", "hint" => "EASY", "value" => "easily", "created_at" => now()],
            ["question_id" => "56", "hint" => "GROW", "value" => "growth", "created_at" => now()],
            ["question_id" => "56", "hint" => "ATTRACT", "value" => "attractions", "created_at" => now()],
            ["question_id" => "56", "hint" => "FASHION", "value" => "fashionable", "created_at" => now()],
            ["question_id" => "56", "hint" => "DELIGHT", "value" => "delightful", "created_at" => now()],
            ["question_id" => "56", "hint" => "LIKE", "value" => "unlike", "created_at" => now()],

            ["question_id" => "57", "hint" => "SURPRISE", "value" => "surprisingly", "created_at" => now()],
            ["question_id" => "57", "hint" => "LIKE", "value" => "unlike", "created_at" => now()],
            ["question_id" => "57", "hint" => "ENTIRE", "value" => "entirely", "created_at" => now()],
            ["question_id" => "57", "hint" => "CONSQUENCE", "value" => "consequently", "created_at" => now()],
            ["question_id" => "57", "hint" => "WEIGH", "value" => "weight", "created_at" => now()],
            ["question_id" => "57", "hint" => "ROUGH", "value" => "roughly", "created_at" => now()],
            ["question_id" => "57", "hint" => "HOT", "value" => "heat", "created_at" => now()],
            ["question_id" => "57", "hint" => "DESCEND", "value" => "descent", "created_at" => now()],
            ["question_id" => "57", "hint" => "ABLE", "value" => "enables", "created_at" => now()],

            ["question_id" => "58", "hint" => "HISTORY", "value" => "historians", "created_at" => now()],
            ["question_id" => "58", "hint" => "INHABIT", "value" => "inhabitants", "created_at" => now()],
            ["question_id" => "58", "hint" => "ACTIVE", "value" => "activity", "created_at" => now()],
            ["question_id" => "58", "hint" => "RECOGNISE", "value" => "recognition", "created_at" => now()],
            ["question_id" => "58", "hint" => "USUAL", "value" => "unusual", "created_at" => now()],
            ["question_id" => "58", "hint" => "IMPROVE", "value" => "improvements", "created_at" => now()],
            ["question_id" => "58", "hint" => "PARTICULAR", "value" => "particularly", "created_at" => now()],
            ["question_id" => "58", "hint" => "COMPETE", "value" => "competitive", "created_at" => now()],
            ["question_id" => "58", "hint" => "CHALLENGE", "value" => "challenging", "created_at" => now()],

            ["question_id" => "59", "hint" => "ASSIST", "value" => "assistance", "created_at" => now()],
            ["question_id" => "59", "hint" => "CROWD", "value" => "crowded", "created_at" => now()],
            ["question_id" => "59", "hint" => "COLLECT", "value" => "collection", "created_at" => now()],
            ["question_id" => "59", "hint" => "VARY", "value" => "variety", "created_at" => now()],
            ["question_id" => "59", "hint" => "POISON", "value" => "poisonous", "created_at" => now()],
            ["question_id" => "59", "hint" => "CONVINCE", "value" => "unconvinced", "created_at" => now()],
            ["question_id" => "59", "hint" => "FOOD", "value" => "feeding", "created_at" => now()],
            ["question_id" => "59", "hint" => "OCCUPY", "value" => "occupation", "created_at" => now()],
            ["question_id" => "59", "hint" => "SURPRISE", "value" => "surprising", "created_at" => now()],

            ["question_id" => "60", "hint" => "OPERATE", "value" => "operation", "created_at" => now()],
            ["question_id" => "60", "hint" => "COAST", "value" => "coastal", "created_at" => now()],
            ["question_id" => "60", "hint" => "FORTUNE", "value" => "fortunately", "created_at" => now()],
            ["question_id" => "60", "hint" => "EXTENT", "value" => "extensive", "created_at" => now()],
            ["question_id" => "60", "hint" => "HOME", "value" => "homeless", "created_at" => now()],
            ["question_id" => "60", "hint" => "CANCEL", "value" => "cancellation", "created_at" => now()],
            ["question_id" => "60", "hint" => "RAIN", "value" => "rainfall", "created_at" => now()],
            ["question_id" => "60", "hint" => "AGRICULTURE", "value" => "agricultural", "created_at" => now()],
            ["question_id" => "60", "hint" => "TEMPORARY", "value" => "temporarily", "created_at" => now()],

            ["question_id" => "61", "hint" => "WISH", "value" => json_encode(["wish I had|bought", "wish I'd|bought"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "62", "hint" => "EVEN", "value" => json_encode(["even though|it was snowing"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "63", "hint" => "SEEN", "value" => json_encode(["if/whether|I'd seen","if/whether|I had seen"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "64", "hint" => "OWN", "value" => json_encode(["on|your own"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "65", "hint" => "RUNG", "value" => json_encode(["would not have rung|if","wouldn't have rung|if"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "66", "hint" => "HAD", "value" => json_encode(["you had|your computer repaired"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "67", "hint" => "BEEN", "value" => json_encode(["must have been|surprised to"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "68", "hint" => "HARDLY", "value" => json_encode(["it|hardly ever"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "69", "hint" => "TAKES", "value" => json_encode(["it takes me|twenty minutes"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "70", "hint" => "PREVENTED", "value" => json_encode(["prevented us (from)|going/getting"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "71", "hint" => "SOON", "value" => json_encode(["as soon as|you hear"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "72", "hint" => "RATHER", "value" => json_encode(["'d rather|you didn't","would rather|you didn't","'d rather|you did not","would rather|you did not"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "73", "hint" => "SUCCEED", "value" => json_encode(["succeed in|winning/getting/obtaining"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "74", "hint" => "ANYBODY", "value" => json_encode(["there was hardly anybody|in/at"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "75", "hint" => "CARE", "value" => json_encode(["taking|care of"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "76", "hint" => "SILLIEST", "value" => json_encode(["the silliest|I've ever","the silliest|I have ever"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "77", "hint" => "FELT", "value" => json_encode(["(me) how|I felt about"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "78", "hint" => "UNLIKELY", "value" => json_encode(["is unlikely|to go/carry"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "79", "hint" => "THOUGHT", "value" => json_encode(["is thought|to be"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "80", "hint" => "BORROW", "value" => json_encode(["if/whether|he could borrow"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "81", "hint" => "MISSED", "value" => json_encode(["would have mised|the beginning/start","would've missed|the beginning/start"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "82", "hint" => "WERE", "value" => json_encode(["were you I'd|make","were you I would|make"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "83", "hint" => "RIDDEN", "value" => json_encode(["was (being) ridden|by"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "84", "hint" => "WISH", "value" => json_encode(["wish I had not|gone","wish I hadn't|gone"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "85", "hint" => "CASE", "value" => json_encode(["in case|we need/have"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "86", "hint" => "TOLD", "value" => json_encode(["told Jamie|not to be"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "87", "hint" => "BEING", "value" => json_encode(["is being made|by"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "88", "hint" => "WORSE", "value" => json_encode(["was worse|than we had","was worse|than we'd","was worse|than"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "89", "hint" => "DIFFICULT", "value" => json_encode(["found it difficult|to print"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
            ["question_id" => "90", "hint" => "ALLOWED", "value" => json_encode(["we're not allowed|to","we are not allowed|to","we aren't allowed|to"], JSON_UNESCAPED_SLASHES), "created_at" => now()],
        ]);
    }
}
