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
        $stats['totalUsers'] = User::count();

        $stats['weeklyUsers'] = User::where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();
        $totalSchools = School::count();
        $stats['totalSchools'] = $totalSchools;

        $stats['weeklySchools'] = School::where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();

        $stats["exercisesDone"] = DB::table('user_records')->count();
        $stats['countPart1'] = Exercise::where('part', '1')->count();
        $stats['countPart2'] = Exercise::where('part', '2')->count();
        $stats['countPart3'] = Exercise::where('part', '3')->count();
        $stats['countPart4'] = Exercise::where('part', '4')->count();

        //new things here to not confuse

        $stats['avgPerUser'] = round(DB::table('user_records')->count() / User::count());
        $stats["dailyUsers"] = DB::table('user_records')
            ->where('timestamp', '>=', Carbon::today())
            ->distinct('user_id')
            ->count('user_id');
        $stats['mostActiveHour'] = DB::table('user_records')
            ->selectRaw('HOUR(timestamp) as hour, COUNT(*) as activity_count')
            ->groupBy('hour')
            ->orderByDesc('activity_count')
            ->limit(1)
            ->value('hour');
        $stats['totalTime'] = DB::table('user_records')->sum('time_spent');

        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        // Get the number of users registered this week
        $currentWeekUsers = User::whereBetween('created_at', [$startOfWeek, Carbon::now()])->count();

        // Get the number of users registered last week
        $lastWeekUsers = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();

        // Calculate growth percentage
        if ($lastWeekUsers > 0) {
            $growthPercentage = (($currentWeekUsers - $lastWeekUsers) / $lastWeekUsers) * 100;
        } else {
            $growthPercentage = (User::count()) * 100;
        }
        $growthPercentage = max(0, $growthPercentage);

        $stats['userGrowthPercentage'] = round($growthPercentage, 2);

        $roleBreakdown = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role');

        $stats['roleBreakdown'] = $roleBreakdown;

        $mostActiveUsers = DB::table('user_records')
            ->join('users', 'user_records.user_id', '=', 'users.id')
            ->select('users.name', DB::raw('COUNT(user_records.id) as activity_count'))
            ->where('user_records.timestamp', '>=', $startOfWeek)
            ->groupBy('users.id', 'users.name') // Add 'users.name' to the GROUP BY
            ->orderByDesc('activity_count')
            ->limit(3)
            ->get();

        $stats['mostActiveUsers'] = $mostActiveUsers;
        $stats['usersPerSchool'] = $totalSchools > 0
            ? round(User::whereNotNull('school_id')->count() / $totalSchools)
            : 0;

        $stats['mostActiveSchool'] = DB::table('user_records')
            ->join('users', 'user_records.user_id', '=', 'users.id')
            ->join('schools', 'users.school_id', '=', 'schools.id')
            ->select('schools.name as school_name', DB::raw('COUNT(user_records.id) as activity_count'))
            ->where('user_records.timestamp', '>=', $startOfWeek)
            ->groupBy('schools.id', 'schools.name')
            ->orderByDesc('activity_count')
            ->limit(1)
            ->first();

        $schoolGrowth = function () {
            $startOfWeek = now()->startOfWeek();
            $startOfLastWeek = $startOfWeek->copy()->subWeek();

            $thisWeekCount = DB::table('schools')
                ->where('created_at', '>=', $startOfWeek)
                ->count();

            $lastWeekCount = DB::table('schools')
                ->where('created_at', '>=', $startOfLastWeek)
                ->where('created_at', '<', $startOfWeek)
                ->count();

            $growthRate = $lastWeekCount > 0
                ? max(0, round((($thisWeekCount - $lastWeekCount) / $lastWeekCount) * 100, 2))
                : ($thisWeekCount > 0 ? 100 : 0);

            return $growthRate;
        };
        $stats['schoolGrowth'] = $schoolGrowth();

        $sevenDaysAgo = now()->subDays(7);

        $stats['countWeekPart1'] = Exercise::where('part', '1')
            ->whereBetween('created_at', [$sevenDaysAgo, now()])
            ->count();

        $stats['countWeekPart2'] = Exercise::where('part', '2')
            ->whereBetween('created_at', [$sevenDaysAgo, now()])
            ->count();

        $stats['countWeekPart3'] = Exercise::where('part', '3')
            ->whereBetween('created_at', [$sevenDaysAgo, now()])
            ->count();

        $stats['countWeekPart4'] = Exercise::where('part', '4')
            ->whereBetween('created_at', [$sevenDaysAgo, now()])
            ->count();

        $statsPart1 = DB::table('user_records')
            ->join('exercises', 'user_records.exercise_id', '=', 'exercises.id')
            ->where('exercises.part', '1')
            ->selectRaw('COUNT(*) as total_records, SUM(user_records.score) as total_score')
            ->first();

        $stats['avgPart1Score'] = $statsPart1->total_records
            ? round($statsPart1->total_score / $statsPart1->total_records, 1)
            : 0;
        $statsPart2 = DB::table('user_records')
            ->join('exercises', 'user_records.exercise_id', '=', 'exercises.id')
            ->where('exercises.part', '2')
            ->selectRaw('COUNT(*) as total_records, SUM(user_records.score) as total_score')
            ->first();

        $stats['avgPart2Score'] = $statsPart2->total_records
            ? round($statsPart2->total_score / $statsPart2->total_records, 1)
            : 0;
        $statsPart3 = DB::table('user_records')
            ->join('exercises', 'user_records.exercise_id', '=', 'exercises.id')
            ->where('exercises.part', '3')
            ->selectRaw('COUNT(*) as total_records, SUM(user_records.score) as total_score')
            ->first();

        $stats['avgPart3Score'] = $statsPart3->total_records
            ? round($statsPart3->total_score / $statsPart3->total_records, 1)
            : 0;
        $statsPart4 = DB::table('user_records')
            ->join('exercises', 'user_records.exercise_id', '=', 'exercises.id')
            ->where('exercises.part', '4')
            ->selectRaw('COUNT(*) as total_records, SUM(user_records.score) as total_score')
            ->first();

        $stats['avgPart4Score'] = $statsPart4->total_records
            ? round($statsPart4->total_score / $statsPart4->total_records, 1)
            : 0;
        return view('livewire.dashboard-admin')->with("stats", $stats);
    }
}
