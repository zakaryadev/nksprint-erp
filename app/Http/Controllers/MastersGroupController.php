<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\MastersGroup;
use Illuminate\Http\Request;

class MastersGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('masters_group.index', [
            'masterGroups' => MastersGroup::all(),
            'masters' => Master::all()
        ]);
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        MastersGroup::create($validated);
        return redirect()->route('master-groups.index')->with('success', 'Group created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(MastersGroup $masterGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MastersGroup $masterGroup)
    {
        return view('masters_group.edit', [
            'masterGroup' => $masterGroup
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MastersGroup $masterGroup)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $masterGroup->update($validated);
        return redirect()->route('master-groups.index', [
            'masterGroups' => MastersGroup::all(),
            'masters' => Master::all()
        ])->with('success', 'Group updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MastersGroup $masterGroup)
    {
        $masterGroup->delete();
        return redirect()->route('master-groups.index', [
            'masterGroups' => MastersGroup::all(),
            'masters' => Master::all()
        ])->with('success', 'Group deleted successfully');
    }
}
