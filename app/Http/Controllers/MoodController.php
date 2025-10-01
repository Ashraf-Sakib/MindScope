<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function dashboard()
    {
        $recentMoods = Auth::user()
            ->moods()
            ->latest()
            ->take(5)
            ->get();

        $todayCount = Auth::user()->moods()->whereDate('created_at', today())->count();
        $weeklyCount = Auth::user()->moods()->where('created_at', '>=', now()->subWeek())->count();
        $totalCount = Auth::user()->moods()->count();

        return view('dashboard', compact('recentMoods', 'todayCount', 'weeklyCount', 'totalCount'));
    }
    public function index()
    {
        $moods = Auth::user()->moods()->latest()->paginate(20);

        return view('moods.index', compact('moods'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mood' => 'required|in:happy,sad,tired,stressed,excited,anxious,calm,angry',
            'note' => 'nullable|string|max:500',
        ]);

        Auth::user()->moods()->create($validated);

        return redirect()->route('moods.index')
            ->with('success', 'Mood entry saved successfully!');
    }

    public function destroy(Mood $mood)
    {
        if ($mood->user_id !== Auth::id()) {
            abort(403);
        }

        $mood->delete();

        return redirect()->route('moods.index')
            ->with('success', 'Mood entry deleted successfully!');
    }

    // Weekly report
    public function weeklyReport()
    {
        $weeklyMoods = Auth::user()->moods()
            ->where('created_at', '>=', now()->subWeek())
            ->get();

        $mostCommonMood = $weeklyMoods->isEmpty() ? null : $weeklyMoods->groupBy('mood')->sortByDesc(function($group) {
            return $group->count();
        })->keys()->first();

        $uniqueDays = $weeklyMoods->unique(function ($mood) {
            return $mood->created_at->toDateString();
        })->count();

        $consistencyRate = round(($uniqueDays / 7) * 100);

        return view('moods.weekly_report', compact('weeklyMoods', 'mostCommonMood', 'consistencyRate'));
    }

    // Relief page
    public function relief()
    {
        return view('moods.relief');
    }
}
