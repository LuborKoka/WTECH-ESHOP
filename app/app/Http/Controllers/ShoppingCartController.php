<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use App\Models\User;
use App\Models\CartItem;
use App\Http\Requests\StoreShoppingCartRequest;
use App\Http\Requests\UpdateShoppingCartRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Find cart by user_id
     */

     public function find_cart(?User $user) {
        if ($user === null) {
            return ShoppingCart::create();
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
     * Add item to cart
     */

    public function addItem(Request $request) {
        $book_id = $request->input('book_id');
        $count = $request->input('count');

        $user = null;

        if (auth()->check()) {
            $user = auth()->user();
        }

        $cart = $this->find_cart($user);

        $item = CartItem::create([
            'shopping_cart_id' => $cart->id,
            'book_id' => $book_id,
            'count' => $count
        ]);

        return redirect()->intended(RouteServiceProvider::CART);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShoppingCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = null;

        if (auth()->check()) {
            $user = auth()->user();
        }

        $cart = $this->find_cart($user);

        return view('pages.shopping-cart', ['cart' => $cart]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShoppingCartRequest $request, ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingCart $shoppingCart)
    {
        //
    }
}
