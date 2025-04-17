<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Teachers_Cohorts;
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

        $students_Cohorts = $cohort->students;
        $students = User::all();
        $User_schools = UserSchool::where('role', 'student')->get();
        return view('pages.cohorts.show', compact('cohort', 'students','User_schools','students_Cohorts'));
    }



    /**
     * this function Add a new Cohort in the list of cohort
     */
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



    /**
     * this function Update a Cohort of the list
     */
    public function UpdateCohort(Request $request, $id)
    {
        //Type Verification
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'number_of_students' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        //Find the id of Cohort
        $cohort = \App\Models\Cohort::find($id);

        //Execute this modifications
        $cohort->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'number_of_students' => $validated['number_of_students'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        return response()->json(['message' => 'Promotion mise à jour avec succès.', 'cohort' => $cohort]);
    }


    /**
     * This function assigns a student to a promotion
     */
    public function attachStudentToCohort(Request $request, Cohort $cohort)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'cohort_id' => 'nullable|exists:cohorts,id',
        ]);

        // Lier l'étudiant à la promotion via la table pivot cohort_student
        $cohort->students()->syncWithoutDetaching([$validated['student_id']]);

        // Si une cohorte est spécifiée, vous pouvez gérer l'ajout dans la table Teachers_Cohorts
        if ($request->filled('cohort_id')) {
            Teachers_Cohorts::create([
                'cohort_id' => $validated['cohort_id'],
                'teacher_id' => $validated['student_id'], // Ceci est spécifique à votre logique.
            ]);
        }

        return redirect()->back()->with('success', 'Étudiant ajouté à la promotion.');
    }




    /**
     * This function delete a cohort
     */
    public function delete_cohort($id)
    {
        //Get id of Cohort
        $cohort_delete = Cohort::find($id);
        //Delete this cohort of table
        $cohort_delete->delete();

        return redirect()->back();
    }
}
