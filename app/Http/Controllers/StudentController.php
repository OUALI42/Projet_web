<?php

namespace App\Http\Controllers;

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
        $students = \App\Models\User::whereHas('schools', function ($query) {
            $query->where('role', 'student');
        })->latest()->get();

        return view('pages.students.index', compact('students'));
    }

    /**
     * this function saves the information on the Student and add this in to the table
     */
    public function store(Request $request)
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
        $validated = $request->validate([
            'last_name'     => 'required|string|max:255',
            'first_name'    => 'required|string|max:255',
            'birth_date'    => 'nullable|date',
            'email'         => 'required|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();

        $user->update($validated);

        return response()->json(['message' => 'Utilisateur mis à jour avec succès.']);
    }


}
