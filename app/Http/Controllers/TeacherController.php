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
}
