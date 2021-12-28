<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsComponent extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function store($product_id,$product_name,$product_price)
    {
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }
    
  
    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $pop_products = Product::inRandomOrder()->limit(4)->get();
        $rel_products = Product::where('cat_id', $product->cat_id)->inRandomOrder()->limit(8)->get();
        return view('livewire.details-component', [
            'product' => $product, 'pop_products' => $pop_products,
            'rel_products' => $rel_products
        ])->layout('layouts.base');
    }
}
