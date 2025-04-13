<?php

namespace App\Livewire;
use DB;
use Illuminate\Database\Query\JoinClause;
use App\Models\Exercise;
use Livewire\Component;

class DashboardPartFourStats extends Component
{
    public function render()
    {


        $stats = DB::table('user_records')
        ->join('users', function (JoinClause $join) {
            $join->on('user_records.user_id', '=', 'users.id');
        })
        ->join('exercises', function (JoinClause $join) {
            $join->on('user_records.exercise_id', '=', 'exercises.id');
        })    ->select(
            'user_records.id as record_id',
            'user_records.timestamp as record_date',
            'users.name as user_name',
            'users.id as user_id',
            'user_records.score as score',
            'exercises.title as title'
        )->where('exercises.part','=','4')->where('users.id','=',auth()->id())->limit(10)
        ->get();
    

        return view('livewire.dashboard-part-four-stats')->with('stats',$stats);
    }
}
