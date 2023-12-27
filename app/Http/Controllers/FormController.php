<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function addCart(Request $request)
    {
        $validatedData = $request->validate([
            'size' => 'required',
            'qty'=> 'required',
            'custom_description' => 'required',
            'design_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Adjust the max size as needed
            'product_id' => 'required',
            'user_id' => 'required'
        ]);

        
        $imageName = Carbon::now()->timestamp.'.'.$request->design_image->getClientOriginalName();
        $request->design_image->storeAs('designs', $imageName);
        $validatedData['design_image'] = $imageName;
        $data = Cart::create($validatedData);
        
        session()->flash('success_message','Item added in Cart');
        return redirect('/cart');
    }
}
