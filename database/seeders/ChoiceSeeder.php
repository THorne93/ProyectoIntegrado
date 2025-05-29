<?php

namespace Database\Seeders;
use App\Models\Choice;
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

            //NEW CHOICES
            ["question_id"=>"46","values"=>"reporting/quoting/according/informing","is_correct"=>"according","created_at"=> now()],
            ["question_id"=>"46","values"=>"taken/carried/studied/worked","is_correct"=>"carried","created_at"=> now()],
            ["question_id"=>"46","values"=>"near/just/close/next","is_correct"=>"close","created_at"=> now()],
            ["question_id"=>"46","values"=>"average/medium/common/standard","is_correct"=>"average","created_at"=> now()],
            ["question_id"=>"46","values"=>"although/despite/however/nevertheless","is_correct"=>"although","created_at"=> now()],
            ["question_id"=>"46","values"=>"belief/information/familiarity/awareness","is_correct"=>"awareness","created_at"=> now()],
            ["question_id"=>"46","values"=>"way/rule/line/case","is_correct"=>"line","created_at"=> now()],
            ["question_id"=>"46","values"=>"tend/lean/head/aim","is_correct"=>"tend","created_at"=> now()],
            ["question_id"=>"46","values"=>"pace/rate/speed/step","is_correct"=>"rate","created_at"=> now()],
            
            ["question_id"=>"47","values"=>"common/frequent/general/routine","is_correct"=>"common","created_at"=> now()],
            ["question_id"=>"47","values"=>"clear/evident/plain/obvious","is_correct"=>"obvious","created_at"=> now()],
            ["question_id"=>"47","values"=>"realised/imagined/invented/dreamt","is_correct"=>"invented","created_at"=> now()],
            ["question_id"=>"47","values"=>"up/over/in/forward","is_correct"=>"up","created_at"=> now()],
            ["question_id"=>"47","values"=>"did/had/made/took","is_correct"=>"had","created_at"=> now()],
            ["question_id"=>"47","values"=>"creation/formation/production/construction","is_correct"=>"production","created_at"=> now()],
            ["question_id"=>"47","values"=>"after/to/since/on","is_correct"=>"on","created_at"=> now()],
            ["question_id"=>"47","values"=>"model/original/sample/standard","is_correct"=>"original","created_at"=> now()],
            ["question_id"=>"47","values"=>"available/achievable/accessible/attainable","is_correct"=>"available","created_at"=> now()],
            
            ["question_id"=>"48","values"=>"far/then/back/past","is_correct"=>"back","created_at"=> now()],
            ["question_id"=>"48","values"=>"close/nearby/near/next","is_correct"=>"nearby","created_at"=> now()],
            ["question_id"=>"48","values"=>"spot/point/tip/dot","is_correct"=>"spot","created_at"=> now()],
            ["question_id"=>"48","values"=>"outer/outdoor/outward/outgoing","is_correct"=>"outdoor","created_at"=> now()],
            ["question_id"=>"48","values"=>"view/regard/thought/belief","is_correct"=>"view","created_at"=> now()],
            ["question_id"=>"48","values"=>"decide/determine/fix/arrange","is_correct"=>"decide","created_at"=> now()],
            ["question_id"=>"48","values"=>"unless/so/if/though","is_correct"=>"so","created_at"=> now()],
            ["question_id"=>"48","values"=>"arrive/get/achieve/reach","is_correct"=>"reach","created_at"=> now()],
            ["question_id"=>"48","values"=>"remarkably/absolutely/extremely/highly","is_correct"=>"absolutely","created_at"=> now()],

            ["question_id"=>"49","values"=>"noticed/solved/found/saw","is_correct"=>"found","created_at"=> now()],
            ["question_id"=>"49","values"=>"crew/staff/team/band","is_correct"=>"staff","created_at"=> now()],
            ["question_id"=>"49","values"=>"delaying/opposing/preventing/according","is_correct"=>"preventing","created_at"=> now()],
            ["question_id"=>"49","values"=>"agreeing/relating/depending/according","is_correct"=>"according","created_at"=> now()],
            ["question_id"=>"49","values"=>"see/do/make/go","is_correct"=>"do","created_at"=> now()],
            ["question_id"=>"49","values"=>"results/leads/causes/creates","is_correct"=>"leads","created_at"=> now()],
            ["question_id"=>"49","values"=>"case/event/time/fact","is_correct"=>"case","created_at"=> now()],
            ["question_id"=>"49","values"=>"few/many/little/much","is_correct"=>"little","created_at"=> now()],
            ["question_id"=>"49","values"=>"feel/take/think/regard","is_correct"=>"take","created_at"=> now()],

            ["question_id"=>"50","values"=>"stands/goes/stays/lies","is_correct"=>"lies","created_at"=> now()],
            ["question_id"=>"50","values"=>"views/scenes/looks/sights","is_correct"=>"views","created_at"=> now()],
            ["question_id"=>"50","values"=>"either/all/both/each","is_correct"=>"both","created_at"=> now()],
            ["question_id"=>"50","values"=>"around/while/throughout/over","is_correct"=>"throughout","created_at"=> now()],
            ["question_id"=>"50","values"=>"past/over/through/beyond","is_correct"=>"over","created_at"=> now()],
            ["question_id"=>"50","values"=>"liked/favourite/enjoyed/popular","is_correct"=>"popular","created_at"=> now()],
            ["question_id"=>"50","values"=>"Since/Although/Despite/However","is_correct"=>"Despite","created_at"=> now()],
            ["question_id"=>"50","values"=>"nearly/hardly/almost/just","is_correct"=>"hardly","created_at"=> now()],
            ["question_id"=>"50","values"=>"want/have/get/need","is_correct"=>"get","created_at"=> now()],
        ]);
    }
}
