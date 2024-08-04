<?php

namespace App\Http\Controllers;

use App\Models\ArrivedProduct;
use App\Models\DecommissionedProduct;
use App\Models\Designer;
use App\Models\Master;
use App\Models\MastersGroup;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function format_money($money)
    {
        return number_format($money, 0, ',', ' ');
    }
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $total_sum = 0;
            foreach (Product::all() as $product) {
                $total_sum += $product->unit_price * $product->quantity;
            }
            $latest_arrive_sum = 0;
            foreach (ArrivedProduct::latest()->take(1)->get() as $product) {
                $latest_arrive_sum += $product->unit_price * $product->quantity;
            }
            $latest_write_off_sum = 0;
            foreach (DecommissionedProduct::latest()->take(1)->get() as $product) {
                $latest_write_off_sum += $product->unit_price * $product->quantity;
            }
            return view('index', [
                'products_sum' => $this->format_money($total_sum),
                'latest_arrive_sum' => $this->format_money($latest_arrive_sum),
                'latest_write_off_sum' => $this->format_money($latest_write_off_sum),
                'services_count' => Service::count(),
                'orders_in_progress' => Order::where('status', 'in_progress')->count(),
                'designers_count' => Designer::count(),
                'master_groups_count' => MastersGroup::count(),
                'masters_count' => Master::count(),
            ]);
        }
        if (auth()->user()->hasRole('designer')) {
            $firstDayOfMonth = Carbon::now()->firstOfMonth()->toDateString();
            $lastDayOfMonth = Carbon::now()->lastOfMonth()->toDateString();
            $designer = Designer::where('user_id', auth()->user()->id)->first();
            $designer['services'] = $designer->ordersServices
                ->where('created_at', '>=', $firstDayOfMonth)
                ->where('created_at', '<=', $lastDayOfMonth);

            return view('index', [
                'orders_in_progress' => Order::where('status', 'in_progress')->count(),
                'designer' => $designer,
            ]);
        }
        if (auth()->user()->hasRole('master')) {
            return view('index');
        }
    }

    public function profile()
    {
        return view('profile.index', [
            'user' => auth()->user(),
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
        ]);
        $user = auth()->user();
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->save();
        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
