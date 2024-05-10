<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ShoppingCart;
use App\Models\OrderItem;
use App\Models\User;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function findCart(?User $user, ?int $cartId = null) {
        if ($user === null) {
            if ( $cartId == null ) {
                return ShoppingCart::create();
            }
            return ShoppingCart::find($cartId);
        }

        $cart = ShoppingCart::where('user_id', $user->id)->first();

        if ($cart !== null) {
            return $cart;
        }

        return ShoppingCart::create([
            'user_id' => $user->id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {
        $form = $request->input('form');
        $cartId = Cookie::get('shopping_cart_id');

        $user = null;

        if ( auth()->check() ) {
            $user = auth()->user();
        }

        $cart = $this->findCart($user, $cartId);

        foreach($cart->cartItems as $item) {
            if ( $item->count > $item->book->stock ) {
                return response()->json(['message' => 'Not enough stock', 'book_title' => $item->book->title], 400);
            }
        }

        $order = Order::create([
            'shipping_address' => $form['address'],
            'zipcode' => $form['zip_code'],
            'city'  => $form['city'],
            'shipping_method'  => (int) $form['shipping'],
            'payment_method'  => (int) $form['payment'],
            'first_name'  => $form['first_name'],
            'last_name'  => $form['last_name'],
            'phone_number'  => $form['phone_number'],
            'email'  => $form['email'],
            'user_id' => $user != null ? (int) $user->id : null,
        ]);

        foreach($cart->cartItems as $item) {
            $book = $item->book;
            $book->stock -= $item->count;
            $book->save();

            OrderItem::create([
                'order_id' => $order->id,
                'name' => $book->title,
                'author_name' => $book->author->name,
                'count' => $item->count,
                'total_cost' => $item->count * $book->cost
            ]);
        }

        $cart->delete();
        if ( !auth()->check() ) {
            Cookie::forget('shopping_cart_id');
        }

        return response()->json(['message' => 'Order created successfully'], 201);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
