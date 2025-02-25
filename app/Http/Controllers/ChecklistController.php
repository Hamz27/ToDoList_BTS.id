<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(['title' => 'required|string']);
        $checklist = Checklist::create([
            'title' => $request->title,
            'user_id' => auth()->user()->id
        ]);

        return response()->json($checklist);
    }

    public function delete($id)
    {
        $checklist = Checklist::find($id);
        if (!$checklist || $checklist->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Not authorized'], 403);
        }

        $checklist->delete();
        return response()->json(['message' => 'Checklist deleted']);
    }

    public function index()
    {
        return response()->json(auth()->user()->checklists);
    }

}
