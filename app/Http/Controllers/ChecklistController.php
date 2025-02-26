<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChecklistController extends Controller
{
    // API untuk membuat checklist
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create checklist
        $checklist = Checklist::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'checklist' => $checklist,
        ], 201);
    }

    // API untuk menghapus checklist
    public function delete($id)
    {
        $checklist = Checklist::find($id);

        if (!$checklist || $checklist->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized or checklist not found'], 404);
        }

        $checklist->delete();
        return response()->json(['success' => true, 'message' => 'Checklist deleted successfully']);
    }

    // API untuk menampilkan semua checklist
    public function index()
    {
        $checklists = Auth::user()->checklists;
        return response()->json([
            'success' => true,
            'checklists' => $checklists,
        ]);
    }

    // API untuk menampilkan detail checklist
    public function show($id)
    {
        $checklist = Checklist::find($id);

        if (!$checklist || $checklist->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized or checklist not found'], 404);
        }

        return response()->json([
            'success' => true,
            'checklist' => $checklist,
        ]);
    }
}
