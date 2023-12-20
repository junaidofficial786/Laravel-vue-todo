<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::orderBy('id', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateItemRequest $request)
    {
        return Item::create($request->validated());
    }

    public function updateName (Request $request, $id)
    {
        $item = Item::find($id);
        $item->name = $request['item']['name'];
        $item->update();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $item = Item::findOrFail($id);
        $item->completed = $request->item['completed'] ? 1 : 0;
        $item->completed_at = $request->item['completed_at'] ? now(): null;
        $item->update();


        return response()->json([
            'status' => 1,
            'message' => "Item updated successfully",
            'data' => $item
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return response()->json([
            'status' => 1,
            'message' => "Item deleted successfully",
            'data' => []
        ], 200);
    }
}
