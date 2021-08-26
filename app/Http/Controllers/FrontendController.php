<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['galleries'])->latest()->get();

        return view('pages.frontend.index', compact('products'));
    }

    public function product(Request $request)
    {
        $products = Product::with(['galleries'])->latest()->get();

        return view('pages.frontend.product', compact('products'));
    }

    public function details(Request $request, $slug)
    {
        $product = Product::with(['galleries'])->where('slug', $slug)->firstOrFail();
        $recommendations = Product::with(['galleries'])->inRandomOrder()->limit(4)->get();
        
        return view('pages.frontend.details', compact('product', 'recommendations'));
    }

    public function cartAdd(Request $request, $id) 
    {
        Cart::create([
            'users_id' => Auth::user()->id,
            'products_id' => $id
        ]);

        return redirect('cart');
    }

    public function cartDelete(Request $request, $id) 
    {
        $item = Cart::findOrFail($id);

        $item->delete();

        return redirect('cart');
    }

    public function cart(Request $request)
    {
        $user = Auth::user();
        $carts = Cart::with(['product.galleries'])->where('users_id', Auth::user()->id)->get();

        return view('pages.frontend.cart', compact('carts','user'));
    }

    public function checkout(CheckoutRequest $request)
    {
        $data = $request->all();

        // Get Carts Data
        $carts = Cart::with(['product'])->where('users_id', Auth::user()->id)->get();

        // Add to Transactions Data
        $data['users_id'] = Auth::user()->id;
        $data['price'] = $carts->sum('product.price');
        $quantity = $request->quantity;
        $data['total_price'] = $data['price'] * $quantity;
        // dd($data['total_price']);

        // Create Transaction
        $transaction = Transaction::create($data);

        // Create Transaction Item
        foreach ($carts as $cart) {
            $item[] = TransactionItem::create([
                'transactions_id' => $transaction->id,
                'users_id' => $cart->users_id,
                'products_id' => $cart->products_id,
                'quantity' => $request->quantity
            ]);
        }

        // Delete Cart After Transaction
        Cart::where('users_id', Auth::user()->id)->delete();

        return redirect('checkout/success');

    }

    public function success(Request $request)
    {
        return view('pages.frontend.success');
    }
}
