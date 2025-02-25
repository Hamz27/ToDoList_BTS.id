<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function addItem(Request $request, $checklistId)
    {
        $checklist = Checklist::find($checklistId);
        if (!$checklist || $checklist->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Not authorized'], 403);
        }

        $item = $checklist->items()->create([
            'name' => $request->name,
        ]);

        return response()->json($item);
    }

    public function updateItem(Request $request, $itemId)
    {
        $item = Item::find($itemId);
        if (!$item || $item->checklist->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Not authorized'], 403);
        }

        $item->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json($item);
    }

}
