<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $today = today();
        $myDates = [];
        
        for($i=1; $i < $today->daysInMonth + 1; ++$i) {
            $myDates[] = Carbon::createFromDate($today->year, $today->month, $i)->format('d/m/Y');
        }
        
        $products = Cart::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()])->get();
        $priceArray = $products->pluck('price')->toArray();

        return view('dashboard', [
            "months_dates" => $myDates,
            "data" => $priceArray,
            "total" => array_sum($priceArray),
            "design_orders" => Cart::count(),
            "design_orders_pending" => Cart::where('status', 'pending')->count(),
            "design_orders_success" => Cart::where('status', 'success')->count(),
            "design_orders_canceled" => Cart::where('status', 'canceled')->count(),
            "product_orders" => Order::count(),
            "products" => Product::count(),
            "product_pending" => Order::where('status', 'pending')->count(),
            "product_success" => Order::where('status', 'success')->count(),
            "product_canceled" => Order::where('status', 'canceled')->count()
        ]);
    }

    public function dateCreator($start, $end){
        $start_date = Carbon::parse($start);
        $end_date = Carbon::parse($end);
        $dates_between = [];
        while ($start_date->lte($end_date)) {
            $dates_between[] = $start_date->format('d/m/Y');
            $start_date->addDay();
        }
        return $dates_between;
    }

    public function cart_search(Request $request){
        $this->validate($request, [
            'starting_date' => 'required',
            'ending_date' => 'required'
        ]);

        $starting = Carbon::createFromDate($request->starting_date);
        $ending = Carbon::createFromDate($request->ending_date);
        if($starting < $ending){
            if($ending <= today()){
                $products = Cart::whereBetween('created_at', [$starting, $ending])->get();
                $priceArray = $products->pluck('price')->toArray();
                
                return view('dashboard', [
                    "months_dates" => $this->dateCreator($starting, $ending),
                    "data" => $priceArray,
                    "total" => array_sum($priceArray),
                    "design_orders" => Cart::count(),
                    "design_orders_pending" => Cart::where('status', 'pending')->count(),
                    "design_orders_success" => Cart::where('status', 'success')->count(),
                    "design_orders_canceled" => Cart::where('status', 'canceled')->count(),
                    "product_orders" => Order::count(),
                    "products" => Product::count(),
                    "product_pending" => Order::where('status', 'pending')->count(),
                    "product_success" => Order::where('status', 'success')->count(),
                    "product_canceled" => Order::where('status', 'canceled')->count()
                ]);
            }else{
                return back()->with('error', 'Ending date must not be greater than today!');
            }
        }else{
            return back()->with('error', 'Starting Date must bee smaller than Ending Date!');
        }
    }



    public function order_search(Request $request){
        $this->validate($request, [
            'starting_date' => 'required',
            'ending_date' => 'required'
        ]);

        $starting = Carbon::createFromDate($request->starting_date);
        $ending = Carbon::createFromDate($request->ending_date);
        if($starting < $ending){
            if($ending <= today()){
                $products = Order::whereBetween('created_at', [$starting, $ending])->get();
                $priceArray = $products->pluck('price')->toArray();
                
                return view('dashboard', [
                    "months_dates" => $this->dateCreator($starting, $ending),
                    "data" => $priceArray,
                    "total" => array_sum($priceArray),
                    "design_orders" => Cart::count(),
                    "products" => Product::count(),
                    "design_orders_pending" => Cart::where('status', 'pending')->count(),
                    "design_orders_success" => Cart::where('status', 'success')->count(),
                    "design_orders_canceled" => Cart::where('status', 'canceled')->count(),
                    "product_orders" => Order::count(),
                    "product_pending" => Order::where('status', 'pending')->count(),
                    "product_success" => Order::where('status', 'success')->count(),
                    "product_canceled" => Order::where('status', 'canceled')->count()
                ]);
            }else{
                return back()->with('error', 'Ending date must not be greater than today!');
            }
        }else{
            return back()->with('error', 'Starting Date must bee smaller than Ending Date!');
        }
    }
}
