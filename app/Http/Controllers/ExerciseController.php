<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Exercise;
use App\Models\Question;
use App\Models\Choice;
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

    public function getExercise($part, $id)
    {
        $exercise = Exercise::find($id);
        $questions = $exercise->questions;

        return view('exercises.play')->with('exercise', $exercise)->with('questions', $questions);
    }

    public function editExercise($part, $id)
    {
        $exercise = Exercise::findOrFail($id);

        // Map part number to corresponding view file
        $views = [
            1 => 'exercises.edit.partone',
            2 => 'exercises.edit.parttwo',
            3 => 'exercises.edit.partthree',
            4 => 'exercises.edit.partfour',
        ];

        // If the part is not valid, abort with 404
        if (!array_key_exists($part, $views)) {
            abort(404);
        }

        return view($views[$part], [
            'exercise' => $exercise,
            'questions' => $exercise->questions,
        ]);
    }

    public function updateExercise($part, $id, Request $request)
    {
        $exercise = Exercise::findOrFail($id);
        switch ($part) {
            case 1:
                $question = Question::where('exercise_id', $id)->first();
                $exercise->title = $request->input('title');
                $question->prompt = $request->input('content');
                foreach ($request->input('question') as $value) {
                    $choice = Choice::findOrFail($value['id']);
                    $choice->is_correct = $value['choice'];
                    $choice->values = implode('/', $value['choices']);
                    $choice->save();
                }
                $question->save();  
                $exercise->save();
                return redirect()->route('admin.exercises')->with('success', 'Exercise updated successfully.');  
            case 2:
                break;
            case 3:
                break;
            case 4:
                break;
        }
    }

    public function create($part) {
        $views = [
            1 => 'exercises.create.partone',
            2 => 'exercises.create.parttwo',
            3 => 'exercises.create.partthree',
            4 => 'exercises.create.partfour',
        ];
        return view ($views[$part]);
    }
}
