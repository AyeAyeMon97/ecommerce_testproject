<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public int $qty = 0;

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }

    public function increaseQuantity($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
        // return redirect('/cart');
        // dd($rowId);
    }

    public function descreaseQuantity($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId,$qty);
        // return redirect('/cart');
    }

    public function destory($rowId){
        Cart::remove($rowId);
        session()->flash('success_message','Item has been remove');
        // return redirect('/cart');
    }

    public function destroyAll(){
        Cart::destroy();
        // return redirect('/cart');
    }

}
