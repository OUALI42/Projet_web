<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Teachers_Cohorts;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::all();
        $User_schools = UserSchool::where('role', 'teacher')->get();

        return view('pages.teachers.index', compact('teachers', 'User_schools'));
    }


    /**
     * this function saves the information on the Teachers and add this in to the table
     */
    public function Save_Teacher(Request $request)
    {
        // Type Verification
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Set a default password
        $validated['password'] = Hash::make('123456');

        // Creation of the teacher
        $user =  User::create($validated);

        UserSchool::create([
            'user_id' => $user->id,
            'school_id' => '1',
            'role' => 'teacher',
        ]);

        return response()->json(['message' => 'Enseignant ajouté avec succès.']);
    }


    /**
     * this function update the information on the Teacher and add this in to the table
     */
    public function UpdateUser(Request $request)
    {
        //      Type Verification
        $validated = $request->validate([
            'current_email' => 'required|email|exists:users,email',
            'last_name'     => 'required|string|max:255',
            'first_name'    => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $request->current_email . ',email',
            'cohort_id' => 'nullable|exists:cohorts,id',
        ]);

        // We retrieve the user by his current email
        $user = \App\Models\User::where('email', $validated['current_email'])->first();


        // Associate a teacher with a Cohort
        if ($request->filled('cohort_id')) {
            Teachers_Cohorts::create([
                'cohort_id' => $validated['cohort_id'],
                'teacher_id' => $user->id,
            ]);
        }

        // Update of informations
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
        ]);

        return response()->json(['message' => 'Utilisateur mis à jour avec succès.']);
    }


    /**
     * this function delete the information on the Teachers and delete this in to the table
     */
    public function delete($id)
    {
        //Get id of user Teachers
        $Teacher_user = User::find($id);
        //Delete this Teachers of table
        $Teacher_user->delete();

        $Teacher_school = UserSchool::find($id);
        $Teacher_school->delete();

        // Delete into Teachers_Cohorts table
        $Teacher_cohort = Teachers_Cohorts::find($id);
        if ($Teacher_cohort) {
            $Teacher_cohort->delete();
        }

        return redirect()->back();
    }
}
