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
        $count = intval($request->input('count'));

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
     * Delete item from shopping cart
     */

    public function deleteItem(Request $request) {
        $id = $request->input('id');

        CartItem::find($id)->delete();

        return response()->noContent();
    }

    /**
     * Update item count
     */

    public function updateItem(Request $request) {
        $id = $request->input('id');
        $count = $request->input('count');

        $item = CartItem::find($id);
        $cartId = $item->shopping_cart_id;

        if ( $count <= 0 ) {
            $item->delete();
        } else {
            $item->count = $count;
            $item->save();
        }

        $cart = ShoppingCart::find($cartId);
        $cost = $this->calculateTotalCost($cart);

        $data = [
            'cost' => $cost,
            'resultCount' => $count         //k celej funkcii bude treba pribalit check, ci neni viac v kosiku ako na sklade
        ];

        return response()->json($data);
    }

    public function calculateTotalCost(ShoppingCart $cart) {
        $result = 0;

        foreach( $cart->cartItems as $item) {
            $result += $item->count * $item->book->cost;
        };

        return round($result, 2);
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

        $cost = $this->calculateTotalCost($cart);

        return view('pages.shopping-cart', ['cart' => $cart, 'cost' => $cost]);
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
