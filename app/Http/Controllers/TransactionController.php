<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Transaction;

class TransactionController extends Controller
{
    //

    public function store(Request $request){
        // dd($request);
        // Validate the form data
        $validated = $request->validate([
            'item_id' => 'required|integer',
        ]);

        // Get the currently authenticated user's ID
        $buyerId = Auth::id();

        $item = Item::find($request->item_id);

        // Create a new Transaction instance 
        $transaction = new Transaction([
            'seller_id' => $item->seller_id,
            'buyer_id' => $buyerId,
            'quantity' => 1,
            'price_total' => $item->price,
            'item_id' => $item->id
        ]);

        // Save the item to the database
        $transaction->save();

        $item->quantity = $item->quantity - 1;
        if ($item->quantity === 0 ){
            $item->is_sold = true;
        }
        $item->save();

        // Redirect the user to a success page or any other appropriate response
        return redirect()->route('shop')->with('success', 'Item purchased successfully');
    }

    public function get_purchased(){
        $user = Auth::user();

        // Retrieve transactions where the seller_id matches the user's ID
        $transactions = Transaction::where('buyer_id', $user->id)->get();

        return view('purchased', ['transactions' => $transactions]);
    }

    public function get_sold(){
        $user = Auth::user();

        // Retrieve transactions where the seller_id matches the user's ID
        $transactions = Transaction::where('seller_id', $user->id)->get();

        return view('sold', ['transactions' => $transactions]);
    }

}
