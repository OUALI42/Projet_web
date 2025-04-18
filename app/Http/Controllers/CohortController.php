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

        // Retrieves all IDs of UserSchool records where the role is "student"
        $students_role = UserSchool::where('role', 'student')->pluck('id');

        $students = User::whereIn('id', $students_role)->get();

        // Get the id of student
        $cohortUsersId = Teachers_Cohorts::where('cohort_id', $cohort->id)->pluck('student_id');

        // Filter UserSchool records to keep only those with student IDs obtained
        $studentsId = UserSchool::whereIn('user_id', $cohortUsersId)
            ->where('role', 'student')
            ->pluck('user_id');

        $cohortStudents = User::whereIn('id', $studentsId)->get();

        $students = User::all();
        $User_schools = UserSchool::where('role', 'student')->get();
        return view('pages.cohorts.show', compact('cohort', 'students','User_schools','cohortStudents'));
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

    public function attachStudentToCohort(Request $request, $cohortId)
    {
        $student_id = $request->input('student_id');

        //  if the student already exists in the Teachers_cohort table
        $exists = Teachers_Cohorts::where('student_id', $student_id)->exists();

        // Create student in the Teachers-Cohorts
        if (!$exists) {
            Teachers_Cohorts::create([
                'cohort_id' => $cohortId,
                'student_id' => $student_id,
                'teacher_id' => null,
            ]);
        }

        return redirect()->back();
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

        // Delete into Teachers_Cohorts table
        $cohort_teachers = Teachers_Cohorts::find($id);
        if ($cohort_teachers) {
            $cohort_teachers->delete();
        }

        return redirect()->back();
    }
}
