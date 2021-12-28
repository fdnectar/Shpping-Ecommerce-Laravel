<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    public function render()
    {
        return view('livewire.cart-component')->layout("layouts.base");
    }
    public function increaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
    }
    public function decreaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);
    }
    public function delete($rowId)
    {
       Cart::remove($rowId);
       session()->flash('success_message', 'Item has been removed');
    }
    public function emptyAll()
    {
        Cart::destroy();
    }
}
