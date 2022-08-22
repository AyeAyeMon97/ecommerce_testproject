<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class ShopComponent extends Component
{
    public $sorting;
    public $pagessize;

    public function mount(){
        $this->sorting = "default";
        $this->pagessize = 12;
    }

    public function store($product_id,$product_name,$product_price){

        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_image','Item added in Cart');
        return redirect()->route('product.cart');
    }

    use WithPagination;
    public function render()
    {
        if($this->sorting =="date"){
            $products = Product::orderBy('created_at','DESC')->paginate($this->pagessize);
            // dd($products);
        }
        else if($this->sorting == "price"){
            $products = Product::orderBy('regular_price','ASC')->paginate($this->pagessize);
        }
        else if($this->sorting == "price-desc"){
            $products = Product::orderBy('regular_price','DESC')->paginate($this->pagessize);
        }
        else{
            $products = Product::paginate($this->pagessize);
            // dd($this->pagessize);
        }
        // $products = Product::paginate(12);

        $categories = Category::limit(6)->get();
        return view('livewire.shop-component',['products'=>$products, 'categories'=>$categories])->layout('layouts.base');
    }
}
