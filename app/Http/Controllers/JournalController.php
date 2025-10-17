<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Journal;


class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::where('user_id', Auth::id())->latest()->get();
        return view('personal_journal', compact('journals'));
    }

    public function create()
    {
        return view('journal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Journal::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('journal.index')->with('success', 'Journal entry added successfully!');
    }

    public function edit($id)
    {
        $journal = Journal::findOrFail($id);
        return view('journal.edit', compact('journal'));
    }

    public function update(Request $request, $id)
    {
        $journal = Journal::findOrFail($id);
        $journal->update($request->only(['title', 'content']));
        return redirect()->route('journal.index')->with('success', 'Journal updated!');
    }

    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);
        $journal->delete();
        return redirect()->route('journal.index')->with('success', 'Journal deleted!');
    }
}