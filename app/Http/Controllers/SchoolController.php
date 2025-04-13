<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{

    public function getStudents()
    {
        $school = Auth::user()->school;
        $students = DB::table('users')
            ->leftJoin('user_records', function ($join) {
                $join->on('users.id', '=', 'user_records.user_id')
                    ->whereRaw('user_records.timestamp = (SELECT MAX(timestamp) FROM user_records WHERE user_records.user_id = users.id)');
            })
            ->where('users.school', $school)
            ->whereNot('users.id', Auth::id())
            ->select('users.*', 'user_records.score', 'user_records.timestamp as date')
            ->get();
        return view('teachers.students')->with('students', $students);
    }

}
