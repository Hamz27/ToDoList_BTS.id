<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    // API untuk membuat item di dalam checklist
    public function create(Request $request, $checklistId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $checklist = Checklist::find($checklistId);

        if (!$checklist || $checklist->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized or checklist not found'], 404);
        }

        $item = Item::create([
            'name' => $request->name,
            'checklist_id' => $checklistId,
        ]);

        return response()->json([
            'success' => true,
            'item' => $item,
        ], 201);
    }

    // API untuk menampilkan detail item
    public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        return response()->json([
            'success' => true,
            'item' => $item,
        ]);
    }

    // API untuk mengubah item
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $item->update($request->only('name'));

        return response()->json([
            'success' => true,
            'item' => $item,
        ]);
    }

    // API untuk mengubah status item
    public function updateStatus(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $item->status = $request->status;  // Assuming 'status' is a boolean (true/false) field
        $item->save();

        return response()->json([
            'success' => true,
            'item' => $item,
        ]);
    }

    // API untuk menghapus item
    public function delete($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item deleted successfully',
        ]);
    }
}
