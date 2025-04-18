<?php

namespace App\Http\Controllers;

use App\Models\CommonLife;
use Illuminate\Http\Request;

class CommonLifeController extends Controller
{
    public function index()
    {
        $studentID = auth()->id();

        //Get the task of the student
        $tasks = CommonLife::where('StudentID', $studentID)->get()->keyBy('Task');

        return view('pages.commonLife.index', compact('tasks'));
    }

    /**
     * This Function can save the task of comon life of student
     */
    public function saveTask(Request $request)
    {
        //Type Verification
        $validated = $request->validate([
            'StudentID' => 'required|integer',
            'Task' => 'required|string',
            'Status' => 'required|boolean',
            'Commentary' => 'nullable|string',
        ]);

        // Know whether to update or create them
        CommonLife::updateOrCreate(
            [
                'StudentID' => $validated['StudentID'],
                'Task' => $validated['Task'],
            ],
            [
                'Status' => $validated['Status'],
                'Commentary' => $validated['Commentary'],
            ]
        );

        return response()->json(['success' => true]);
    }

}
