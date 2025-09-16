<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mood; 

class MoodController extends Controller
{
    // Method to show the mood tracking form
    public function index()
    {
        return view('moods.index'); // Assuming you have a view for the form
    }
    
    // Method to store the mood data
    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        $mood = new Mood();
        $mood->user_id = auth()->id();
        $mood->mood = $request->mood;
        $mood->note = $request->note;
        $mood->save();

        return redirect()->back()->with('success', 'Mood saved successfully!');
    }
}