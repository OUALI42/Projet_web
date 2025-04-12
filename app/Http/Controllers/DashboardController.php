<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Group;
use App\Models\Students;
use App\Models\Teacher;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
//        counting the antitheses of a table
        $promotionsCount = Cohort::count();
        $studentsCount = UserSchool::where('role', 'student')->count();
        $teachersCount = UserSchool::where('role', 'teacher')->count();
        $userRole = auth()->user()->school()->pivot->role;

        return view('pages.dashboard.dashboard-' . $userRole, compact('promotionsCount', 'studentsCount', 'teachersCount'));
    }
}
