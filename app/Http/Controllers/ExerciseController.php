<?php

namespace App\Http\Controllers;
use App\Models\Answer;
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
        if (Auth::user()->role == "Student") {
            $sql = "
                SELECT E.*, UR.score, UR.time_spent, UR.timestamp
                FROM exercises E
                LEFT JOIN user_records UR ON E.id = UR.exercise_id
                    AND UR.user_id = ?
                    AND UR.timestamp = (
                        SELECT MAX(UR2.timestamp)
                        FROM user_records UR2
                        WHERE UR2.exercise_id = E.id
                          AND UR2.user_id = ?
                    )
                WHERE E.part = ?
                ORDER BY UR.timestamp ASC
            ";

            $exercises = DB::select($sql, [Auth::user()->id, Auth::user()->id, $part]);
        } else {
            $schoolId = Auth::user()->school_id;

            $exercises = DB::table('user_records as UR')
                ->join('exercises as E', 'UR.exercise_id', '=', 'E.id')
                ->join('users as U', 'UR.user_id', '=', 'U.id')
                ->where('E.part', $part)
                ->where('U.id', '!=', Auth::user()->id)
                ->where('U.school_id', $schoolId)
                ->whereRaw('UR.timestamp = (
        SELECT MAX(UR2.timestamp)
        FROM user_records UR2
        JOIN users U2 ON UR2.user_id = U2.id
        WHERE UR2.exercise_id = UR.exercise_id
          AND U2.school_id = ?
    )', [$schoolId])
                ->select(
                    'E.id as id',
                    'E.title as title',
                    'E.part',
                    'UR.score as score',
                    'UR.time_spent',
                    'UR.timestamp',
                    'U.name as student_name',
                    'U.surname as student_surname'
                )
                ->orderBy('UR.timestamp', 'DESC')
                ->get();

        }
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

        $views = [
            1 => 'exercises.edit.partone',
            2 => 'exercises.edit.parttwo',
            3 => 'exercises.edit.partthree',
            4 => 'exercises.edit.partfour',
        ];

        if (!array_key_exists($part, $views)) {
            abort(404);
        }

        return view($views[$part], [
            'exercise' => $exercise,
            'questions' => $exercise->questions,
        ]);
    }
    public function create($part)
    {
        $views = [
            1 => 'exercises.create.partone',
            2 => 'exercises.create.parttwo',
            3 => 'exercises.create.partthree',
            4 => 'exercises.create.partfour',
        ];
        return view($views[$part]);
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
                $question = Question::where('exercise_id', $id)->first();
                $exercise->title = $request->input('title');
                $question->prompt = $request->input('content');
                foreach ($request->input('answers') as $value) {
                    $answer = Answer::findOrFail($value['id']);
                    $answer->value = $value['value'];
                    $answer->save();
                }
                $question->save();
                $exercise->save();
                return redirect()->route('admin.exercises')->with('success', 'Exercise updated successfully.');
            case 3:
                $question = Question::where('exercise_id', $id)->first();
                $exercise->title = $request->input('title');
                $question->prompt = $request->input('content');
                foreach ($request->input('answers') as $value) {
                    $answer = Answer::findOrFail($value['id']);
                    $answer->value = $value['value'];
                    $answer->hint = $value['hint'];
                    $answer->save();
                }
                $question->save();
                $exercise->save();
                return redirect()->route('admin.exercises')->with('success', 'Exercise updated successfully.');

            case 4:
                $exercise->title = $request->input('title');
                foreach ($request->input('answers') as $value) {
                    $question = Question::findOrFail($value['id']);
                    $question->prompt = $value['prompt'];
                    $question->before_prompt = $value['before'];
                    $question->after_prompt = $value['after'];
                    $answer = Answer::where('question_id', $question->id)->first();
                    $answer->hint = $value['hint'];
                    $formattedAnswers = array_values(
                        collect($value['option'] ?? [])
                            ->filter(fn($pair) => !empty($pair['a1']) && !empty($pair['a2']))
                            ->map(fn($pair) => implode('|', [$pair['a1'], $pair['a2']]))
                            ->toArray()
                    );
                    $answer->value = json_encode($formattedAnswers);
                    $answer->save();
                    $question->save();
                }
                $exercise->save();
                return redirect()->route('admin.exercises')->with('success', 'Exercise updated successfully.');
        }
    }

    public function submit($part, Request $request)
    {

        switch ($part) {
            case 1:
                $exercise = new Exercise();
                $exercise->part = 1;
                $exercise->title = $request->input('title');
                $exercise->save();
                $question = new Question();
                $question->exercise_id = $exercise->id;
                $question->is_multiple_choice = 1;
                $question->prompt = $request->input('content');
                $question->save();
                foreach ($request->input('question') as $value) {
                    $choice = new Choice();
                    $choice->question_id = $question->id;
                    $choice->is_correct = $value['choices'][$value['choice']];
                    $choice->values = implode('/', $value['choices']);
                    $choice->save();
                }
                return redirect()->route('admin.exercises')->with('success', 'Exercise created successfully.');
            case 2:
                $exercise = new Exercise();
                $exercise->part = 2;
                $exercise->title = $request->input('title');
                $exercise->save();
                $question = new Question();
                $question->exercise_id = $exercise->id;
                $question->prompt = $request->input('content');
                $question->save();
                foreach ($request->input('answers') as $value) {
                    $answer = new Answer();
                    $answer->question_id = $question->id;
                    $answer->value = $value['value'];
                    $answer->save();
                }
                return redirect()->route('admin.exercises')->with('success', 'Exercise created successfully.');

            case 3:
                $exercise = new Exercise();
                $exercise->part = 3;
                $exercise->title = $request->input('title');
                $exercise->save();
                $question = new Question();
                $question->exercise_id = $exercise->id;
                $question->prompt = $request->input('content');
                $question->save();
                foreach ($request->input('answers') as $value) {
                    $answer = new Answer();
                    $answer->question_id = $question->id;
                    $answer->value = $value['value'];
                    $answer->hint = $value['hint'];
                    $answer->save();
                }
                return redirect()->route('admin.exercises')->with('success', 'Exercise created successfully.');
            case 4:
                $exercise = new Exercise();
                $exercise->part = 4;
                $exercise->title = $request->input('title');
                $exercise->save();
                foreach ($request->input('answers') as $value) {
                    $question = new Question();
                    $question->exercise_id = $exercise->id;
                    $question->prompt = $value['prompt'];
                    $question->before_prompt = $value['before'];
                    $question->after_prompt = $value['after'];
                    $question->save();
                    $answer = new Answer();
                    $answer->question_id = $question->id;
                    $answer->hint = $value['hint'];
                    $formattedAnswers = array_values(
                        collect($value['option'] ?? [])
                            ->filter(fn($pair) => !empty($pair['a1']) && !empty($pair['a2']))
                            ->map(fn($pair) => implode('|', [$pair['a1'], $pair['a2']]))
                            ->toArray()
                    );
                    $answer->value = json_encode($formattedAnswers);
                    $answer->save();
                }
                return redirect()->route('admin.exercises')->with('success', 'Exercise created successfully.');
        }
    }
}
