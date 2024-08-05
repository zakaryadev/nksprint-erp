<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\MastersGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('masters.index', [
            'masters' => Master::all(),
            'masterGroups' => MastersGroup::all(),
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
        $user_valid = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $master_valid = $request->validate([
            'masters_group_id' => 'required',
            'procent' => 'required',
            'salary' => 'required'
        ]);
        $user = User::create([
            'first_name' => $user_valid['first_name'],
            'last_name' => $user_valid['last_name'],
            'email' => $user_valid['email'],
            'phone_number' => $user_valid['phone_number'],
            'password' => Hash::make($user_valid['password'])
        ]);
        $user->assignRole('master');
        Master::create([
            'user_id' => $user->id,
            'masters_group_id' => $master_valid['masters_group_id'],
            'procent' => $master_valid['procent'],
            'salary' => $master_valid['salary']
        ]);

        return view('masters.index', [
            'masters' => Master::all(),
            'masterGroups' => MastersGroup::all()
        ])->with('success', 'Master created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Master $master)
    {
        $total_sum = 0;
        foreach ($master->mastersGroup->ordersServices as $ordersService) {
            $total_sum += ($ordersService->quantity * $ordersService->service->price * $ordersService->width * $ordersService->height) / 100 * $master->procent;
        }
        return view('masters.show', [
            'master' => $master,
            'masterGroups' => MastersGroup::all(),
            'total_sum' => $total_sum
        ]);
    }

    public function edit(Master $master)
    {
        return view('masters.edit', [
            'master' => $master,
            'masterGroups' => MastersGroup::all()
        ]);
    }

    public function update(Request $request, Master $master)
    {
        $user_valid = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $master_valid = $request->validate([
            'masters_group_id' => 'required',
            'procent' => 'required',
            'salary' => 'required'
        ]);
        $user = User::find($master->user_id);
        $user->update([
            'first_name' => $user_valid['first_name'],
            'last_name' => $user_valid['last_name'],
            'email' => $user_valid['email'],
            'phone_number' => $user_valid['phone_number'],
            'password' => Hash::make($user_valid['password'])
        ]);
        $master->update([
            'masters_group_id' => $master_valid['masters_group_id'],
            'procent' => $master_valid['procent'],
            'salary' => $master_valid['salary']
        ]);

        return view('masters.index', [
            'masters' => Master::all(),
            'masterGroups' => MastersGroup::all()
        ])->with('success', 'Master updated successfully!');
    }

    public function destroy(Master $master)
    {
        $master->user()->delete();
        $master->delete();
        return view('masters.index', [
            'masters' => Master::all(),
            'masterGroups' => MastersGroup::all()
        ]);
    }
}
