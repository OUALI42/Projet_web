<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\User;
use App\Models\UserSchool;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CohortController extends Controller
{
    /**
     * Display all available cohorts
     * @return Factory|View|Application|object
     */

    public function index()
    {
        $cohorts = Cohort::all();

        $user = auth()->user();

        // Filter yourself promotion
        $cohorts_teachers = $user->cohorts()->get();

        return view('pages.cohorts.index', compact('cohorts','cohorts_teachers'));
    }




    /**
     * Display a specific cohort
     * @param Cohort $cohort
     * @return Application|Factory|object|View
     */
    public function show(Cohort $cohort) {

        $students = User::all();
        $User_schools = UserSchool::where('role', 'student')->get();
        return view('pages.cohorts.show', compact('cohort', 'students','User_schools'));
    }

    public function Add_Cohort(Request $request)
    {
        //Type Verification
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'number_of_students' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Adding school (default 1 here, but to dynamically adapt if needed)
        $validated['school_id'] = auth()->user()->school_id ?? 1;

        // Creation of the promotion
        Cohort::create($validated);

        return response()->json(['message' => 'Promotion ajoutée avec succès.']);
    }

    public function UpdateCohort(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'number_of_students' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $cohort = \App\Models\Cohort::find($id);

        $cohort->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'number_of_students' => $validated['number_of_students'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        return response()->json(['message' => 'Promotion mise à jour avec succès.', 'cohort' => $cohort]);
    }

    public function delete_cohort($id)
    {
        //Get id of Cohort
        $cohort_delete = Cohort::find($id);
        //Delete this cohort of table
        $cohort_delete->delete();

        return redirect()->back();
    }


}
