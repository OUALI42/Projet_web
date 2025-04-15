<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
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
//    public function index()
//    {
////        information for the variable  cohort
//        $schoolId = auth()->user()->school_id;
//
//        $cohorts = Cohort::where('school_id', auth()->user()->school_id)
//            ->orderBy('start_date', 'desc')
//            ->get()
//            ->map(function ($cohort) {
//                $cohort->students_count = \App\Models\User::where('cohort_id', $cohort->id)->where('role', 'student')->count();
//                return $cohort;
//            });
//
//        return view('pages.cohorts.index', compact('cohorts'));
//    }


    public function index()
    {
        $cohorts = Cohort::all();
        return view('pages.cohorts.index', compact('cohorts'));
    }




    /**
     * Display a specific cohort
     * @param Cohort $cohort
     * @return Application|Factory|object|View
     */
    public function show(Cohort $cohort) {

        return view('pages.cohorts.show', [
            'cohort' => $cohort
        ]);
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

    public function UpdateCohort(Request $request)
    {
        //      Type Verification
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'number_of_students' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // We retrieve the user by his current email
        $Cohort = \App\Models\Cohort::where('email', $validated['current_email'])->first();

        // Update of informations
        $Cohort->update([
            'name' => $validated['name'],
            'description'  => $validated['description'],
            'number_of_students' => $validated['number_of_students'],
            'start_date'      => $validated['start_date'],
            'end_date'      => $validated['end_date'],
        ]);

        return response()->json(['message' => 'Utilisateur mis à jour avec succès.']);
    }

}
