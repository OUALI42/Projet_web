<?php

namespace App\Http\Controllers;

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

    public function Save_Teacher(Request $request)
    {
        // Type Verification
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

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

    public function UpdateUser(Request $request)
    {
        //      Type Verification
        $validated = $request->validate([
            'current_email' => 'required|email|exists:users,email',
            'last_name'     => 'required|string|max:255',
            'first_name'    => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email,' . $request->current_email . ',email',
        ]);

        // We retrieve the user by his current email
        $user = \App\Models\User::where('email', $validated['current_email'])->first();


        // Update of informations
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
        ]);

        return response()->json(['message' => 'Utilisateur mis à jour avec succès.']);
    }

    public function delete($id)
    {
        //Get id of user student
        $user_student = User::find($id);
        //Delete this student of table
        $user_student->delete();

        $student_school = UserSchool::find($id);
        $student_school->delete();

        return redirect()->back();
    }
}
