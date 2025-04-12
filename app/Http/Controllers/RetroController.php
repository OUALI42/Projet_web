<?php

namespace App\Http\Controllers;

use App\Models\Retros;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class RetroController extends Controller
{
    public function index()
    {
        $teacherID = auth()->id();

        $retros = Retros::where('Teacher_id', $teacherID)->get()->keyBy('Retro');

        return view('pages.retros.index', compact('retros'));
    }

    /**
     * this function saves the information on the retro
     */
    public function saveRetro(Request $request)
    {
//      Type Verification
        $validated = $request->validate([
            'Teacher_id' => 'required|integer',
            'Name_of_Promotion' => 'required|string',
            'Retro' => 'required|string',
        ]);

//      Know whether to update or create them
        Retros::updateOrCreate(
            [
                'Teacher_id' => $validated['Teacher_id'],
                'Name_of_Promotion' => $validated['Name_of_Promotion'],
            ],
            [
                'Retro' => $validated['Retro'],
            ]
        );

        return response()->json(['success' => true]);
    }
}
