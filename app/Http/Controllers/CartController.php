<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CartController extends Controller
{
    /**
     * Write code on Method
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Write code on Method
     *
     * @return RedirectResponse()
     */
    public function addToCart($id)
    {
        $menu = Menu::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "mid" => $menu->id,
                "title" => $menu->title,
                "desc" => $menu->desc,
                "price" => $menu->price,
                "category" => $menu->categry,
                "path" => $menu->path,
                "quantity" => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function successOrder(Request $request)
    {
        $total = 0;
        foreach (session('cart') as $item){
            $total += $item['price'] * $item['quantity'];
        }
        $order = Order::create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'num_items' => count(session('cart')),
            'total' => $total
        ]);
        foreach (session('cart') as $item){
            Cart::create([
                'order_id' => $order->id,
                'menu_id' => $item['mid'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        $request->session()->forget('cart');

        return view('thank-you');

    }
}
