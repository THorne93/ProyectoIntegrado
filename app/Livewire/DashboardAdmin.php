<?php

namespace App\Livewire;
use App\Models\Exercise;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
class DashboardAdmin extends Component
{
    public function render()
    {
        $stats["currentUsers"] = DB::table('user_records')
            ->where('timestamp', '>=', Carbon::now()->subMinutes(5))
            ->distinct('user_id')
            ->count('user_id');
        $stats['totalUsers'] = User::where("role", "Student")->count();

        $stats['weeklyUsers'] = User::where('role', 'Student')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();

        $stats['totalSchools'] = School::count();

        $stats['weeklySchools'] = School::where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();
            
        $stats["exercisesDone"] = DB::table('user_records')->count();
        $stats['countPart1'] = Exercise::where('part', '1')->count();
        $stats['countPart2'] = Exercise::where('part', '2')->count();
        $stats['countPart3'] = Exercise::where('part', '3')->count();
        $stats['countPart4'] = Exercise::where('part', '4')->count();

        return view('livewire.dashboard-admin')->with("stats", $stats);
    }
}
