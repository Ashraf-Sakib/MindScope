<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class JournalController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $entries = Journal::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $totalEntries = Journal::where('user_id', $user->id)->count();
        $streak = $this->calculateStreak($user->id);
        
        return view('Journal.personal_journal', compact('entries', 'totalEntries', 'streak'));
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:5000',
            // 'tags' => 'nullable|string|max:255',
            // 'mood' => 'nullable|string|max:50',
            'is_private' => 'nullable|boolean',
        ]);

        Journal::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'] ?? null,
            'content' => $validated['content'],
            // 'tags' => $validated['tags'] ?? null,
            // 'mood' => $validated['mood'] ?? null,
            'is_private' => $request->has('is_private'),
        ]);

        return redirect()->route('journal.index')
            ->with('success', 'Journal entry created successfully!');
    }
    public function show($id): View
    {
        $journal = Journal::findOrFail($id);
        if ($journal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
   return view('Journal.show_journal', compact('journal'));
    }
    public function edit($id): View
    {
        $journal = Journal::findOrFail($id);
        if ($journal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('Journal.journal_edit', compact('journal'));
    }

    /**
     * Update the specified journal entry.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $journal = Journal::findOrFail($id);
        
        // Ensure user can only update their own entries
        if ($journal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string|max:5000',
            // 'tags' => 'nullable|string|max:255',
            // 'mood' => 'nullable|string|max:50',
            'is_private' => 'nullable|boolean',
        ]);

        $journal->update([
            'title' => $validated['title'] ?? null,
            'content' => $validated['content'],
            // 'tags' => $validated['tags'] ?? null,
            // 'mood' => $validated['mood'] ?? null,
            'is_private' => $request->has('is_private'),
        ]);

        return redirect()->route('journal.index')
            ->with('success', 'Journal entry updated successfully!');
    }

    /**
     * Remove the specified journal entry.
     */
    public function destroy($id): RedirectResponse
    {
        $journal = Journal::findOrFail($id);
        
        // Ensure user can only delete their own entries
        if ($journal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $journal->delete();

        return redirect()->route('journal.index')
            ->with('success', 'Journal entry deleted successfully!');
    }
    private function calculateStreak(int $userId): int
    {
        $entries = Journal::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($entries->isEmpty()) {
            return 0;
        }

        $streak = 0;
        $currentDate = Carbon::today();
        $latestEntry = $entries->first();
        $daysDiff = $currentDate->diffInDays($latestEntry->created_at->startOfDay());
        
        if ($daysDiff > 1) {
            return 0; 
        }
        
        $dates = $entries->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d');
        })->unique()->values();
        
        foreach ($dates as $index => $date) {
            $entryDate = Carbon::parse(time: $date);
            $expectedDate = Carbon::today()->subDays($index);
            
            if ($entryDate->format('Y-m-d') === $expectedDate->format('Y-m-d')) {
                $streak++;
            } else {
                break;
            }
        }
        
        return $streak;
    }
}