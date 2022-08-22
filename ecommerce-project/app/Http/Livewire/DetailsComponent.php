<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Cart;

class DetailsComponent extends Component
{
    // public $slug;
    public function mount($id){
        $this->id = $id;
    }
    
    public function store($product_id,$product_name,$product_price){
        // dd($product_name);
   
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session->flash('success_image','Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function render()
    {
        $product = Product::where('id','=',$this->id)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id',$product->id)->inRandomOrder()->limit(5)->get();
        return view('livewire.details-component', ['product'=>$product, 'popular_products'=>$popular_products, 'related_products'=>$related_products])->layout('layouts.base');
    }
}
