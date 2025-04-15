<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Students;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
class StudentController extends Controller
{
    public function index()
    {
        $students = User::all();
        $User_schools = UserSchool::where('role', 'student')->get();

        return view('pages.students.index', compact('students', 'User_schools'));
    }

    /**
     * this function saves the information on the Student and add this in to the table
     */
    public function Save_students(Request $request)
    {
        //      Type Verification
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'birth_date' => 'required|date',
        ]);

        $validated['password'] = Hash::make('123456');

        // Creation of the student
        $user =  User::create($validated);

        UserSchool::create([
            'user_id' => $user->id,
            'school_id' => '1',
            'role' => 'student',
        ]);

        return response()->json(['message' => 'Étudiant ajouté avec succès.']);
    }

    public function UpdateUser(Request $request)
    {
        //      Type Verification
        $validated = $request->validate([
            'current_email' => 'required|email|exists:users,email',
            'last_name'     => 'required|string|max:255',
            'first_name'    => 'required|string|max:255',
            'birth_date'    => 'nullable|date',
            'email'         => 'required|email|max:255|unique:users,email,' . $request->current_email . ',email',
        ]);

        // We retrieve the user by his current email
        $user = \App\Models\User::where('email', $validated['current_email'])->first();

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
        }

        // Update of informations
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'birth_date' => $validated['birth_date'],
            'email'      => $validated['email'],
        ]);

        return response()->json(['message' => 'Utilisateur mis à jour avec succès.']);
    }

    public function delete($id)
    {
        $user_student = User::find($id);
        $user_student->delete();

        $student_school = UserSchool::find($id);
        $student_school->delete();

        return redirect()->back();


    }

}
