<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;

class OrderController extends Controller
{

    public function index()
    {
        //
    }


    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = Order::all();
        return view('dashboard.clients.create_orders' , compact('client','categories' , 'orders'));
    }


    public function store(Request $request, Client $client)
    {
        dd($request->all());
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
