<?php

namespace App\Http\Controllers;

use App\Models\Designer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DesignerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $firstDayOfMonth = Carbon::now()->firstOfMonth()->toDateString();
        $lastDayOfMonth = Carbon::now()->lastOfMonth()->toDateString();
        $designers = [];
        foreach (Designer::all() as $designer) {
            $designer['services'] = $designer->ordersServices
                ->where('created_at', '>=', $firstDayOfMonth)
                ->where('created_at', '<=', $lastDayOfMonth);
            array_push($designers, $designer);
        }
        return view('designers.index', [
            'designers' => $designers
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

        $designer_valid = $request->validate([
            'procent' => 'required',
            'salary' => 'required'
        ]);
        $user = User::create([
            'first_name' => $user_valid['first_name'],
            'last_name' => $user_valid['last_name'],
            'email' => $user_valid['email'],
            'phone_number' => $user_valid['phone_number'],
            'password' => Hash::make($user_valid['password']),
        ]);
        $user->assignRole('designer');
        Designer::create([
            'user_id' => $user->id,
            'procent' => $designer_valid['procent'],
            'salary' => $designer_valid['salary']
        ]);

        $firstDayOfMonth = Carbon::now()->firstOfMonth()->toDateString();
        $lastDayOfMonth = Carbon::now()->lastOfMonth()->toDateString();
        $designers = [];
        foreach (Designer::all() as $designer) {
            $designer['services'] = $designer->ordersServices
                ->where('created_at', '>=', $firstDayOfMonth)
                ->where('created_at', '<=', $lastDayOfMonth);
            array_push($designers, $designer);
        }
        return view('designers.index', [
            'designers' => $designers
        ])->with('success', 'Designer created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Designer $designer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designer $designer)
    {
        return view('designers.edit', [
            'designer' => $designer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Designer $designer)
    {
        $user_valid = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $designer_valid = $request->validate([
            'procent' => 'required',
            'salary' => 'required'
        ]);
        $user = $designer->user();
        $user->update([
            'first_name' => $user_valid['first_name'],
            'last_name' => $user_valid['last_name'],
            'email' => $user_valid['email'],
            'phone_number' => $user_valid['phone_number'],
            'password' => Hash::make($user_valid['password']),
        ]);
        $designer->update($designer_valid);

        $firstDayOfMonth = Carbon::now()->firstOfMonth()->toDateString();
        $lastDayOfMonth = Carbon::now()->lastOfMonth()->toDateString();
        $designers = [];
        foreach (Designer::all() as $designer) {
            $designer['services'] = $designer->ordersServices
                ->where('created_at', '>=', $firstDayOfMonth)
                ->where('created_at', '<=', $lastDayOfMonth);
            array_push($designers, $designer);
        }
        return view('designers.index', [
            'designers' => $designers
        ])->with('success', 'Designer created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designer $designer)
    {
        $designer->delete();
        $designer->user()->delete();
        $firstDayOfMonth = Carbon::now()->firstOfMonth()->toDateString();
        $lastDayOfMonth = Carbon::now()->lastOfMonth()->toDateString();
        $designers = [];
        foreach (Designer::all() as $designer) {
            $designer['services'] = $designer->ordersServices
                ->where('created_at', '>=', $firstDayOfMonth)
                ->where('created_at', '<=', $lastDayOfMonth);
            array_push($designers, $designer);
        }
        return redirect()->route('designers.index', [
            'designers' => $designers
        ])->with('success', 'Designer deleted successfully!');
    }
}
