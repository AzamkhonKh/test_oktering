<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Order::paginate(10);
        return $category;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());
        $order_items = collect(session()->get('cart.items'))
            ->map(fn(int $product_id) => ['product_id' => $product_id, 'order_id' => $order->id]);
        OrderItem::insert($order_items);
        return $order->refresh('items');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        return $order->delete();
    }

    public function add_cart(AddToCartRequest $request)
    {
        session()->push('cart.items', request('product_id'));
        return $this->get_cart();
    }

    public function get_cart()
    {
        if(!empty(session()->get('cart.items')))
            $products = Product::with('parameters')->whereIn('id', session()->get('cart.items'))->get();
        else
            $products = collect([]);
        return $products;
    }
}
