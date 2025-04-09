<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Group;
use App\Models\Students;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $promotionsCount = Cohort::count();
        $studentsCount = Students::count();
        $teachersCount = Teacher::count();
        $groupsCount = Group::count();
        $userRole = auth()->user()->school()->pivot->role;

        return view('pages.dashboard.dashboard-' . $userRole, compact('promotionsCount', 'studentsCount', 'teachersCount', 'groupsCount'));
    }
}
