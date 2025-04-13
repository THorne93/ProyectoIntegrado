<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    public function getIndex($part)
    {
        $exercises = DB::table('exercises as E')
            ->leftJoin('user_records as UR', function ($join) {
                $join->on('E.id', '=', 'UR.exercise_id')
                    ->where('UR.user_id', Auth::id())
                    ->whereRaw('UR.timestamp = (
                     SELECT MAX(UR2.timestamp) 
                     FROM user_records UR2 
                     WHERE UR2.exercise_id = E.id 
                     AND UR2.user_id = ?
                 )', [Auth::id()]);
            })
            ->where('E.part', $part) // Always get exercises for the given part
            ->orderBy('UR.timestamp', 'DESC') // Order by latest records (optional)
            ->select('E.*', 'UR.score', 'UR.time_spent', 'UR.timestamp')
            ->get();

        return view('exercises.exercises-users')->with('exercises', $exercises);
    }
}
