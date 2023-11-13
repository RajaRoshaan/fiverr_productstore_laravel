<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function store(Request $request){
        // dd($request);
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'picture' => 'required|file|mimes:png,jpg',
            'price' => 'required|numeric',
        ]);

        // Get the currently authenticated user's ID
        $sellerId = Auth::id();

        // Storing file
        $fileName = $sellerId.'.'.time().'.'.$request->picture->extension();  
        $request->picture->move(public_path('uploads'), $fileName);

        // Create a new Item instance with the validated data
        $item = new Item([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'quantity' => $validated['quantity'],
            'picture' => $fileName,
            'price' => $validated['price'],
            'is_active' => true,
            'seller_id' => $sellerId,
            'is_sold' => false
        ]);

        // Save the item to the database
        $item->save();

        // Redirect the user to a success page or any other appropriate response
        return redirect()->route('dashboard')->with('success', 'Item added successfully');
    }

    public function index(){
        
        $user = Auth::user();
        $items = $user->items;

        return view('dashboard', ['items' => $items]);
    }

    public function all(){
        $user = Auth::user();
        $items = Item::where('is_active', true)
                    // ->where('seller_id', '!=', $user->id)
                    ->where('is_sold', false)
                    ->where('quantity', '>', 0)
                    ->get();

        return view('shop', ['items' => $items]);
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id); // Retrieve the item to edit
        return view('product-edit', compact('item'));
    }

    public function item($id)
    {
        $item = Item::findOrFail($id); // Retrieve the item to edit
        return view('shop-item', compact('item'));
    }

    public function update(Request $request, $id){
        $item = Item::findOrFail($id); // Retrieve the item to update

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'picture' => 'required|file|mimes:png,jpg',
            'price' => 'required|numeric',
        ]);

        // Get the currently authenticated user's ID
        $sellerId = Auth::id();

        // Storing file
        $fileName = $sellerId.'.'.time().'.'.$request->picture->extension();  
        $request->picture->move(public_path('uploads'), $fileName);

        $item->name = $request['name'];
        $item->description = $request['description'];
        $item->quantity = $request['quantity'];
        $item->picture = $fileName;
        $item->price = $request['price'];

        $item->save();

        return redirect()->route('dashboard')->with('success', 'Item updated successfully');
    }

    public function destroy($id){
        $item = Item::find($id);

        // You may add additional checks, such as verifying ownership or permissions, here
        if ($item->seller_id !== auth()->user()->id) {
            return redirect()->route('items.index')->with('success', 'You do not have permission to edit this product.');
        }

        // Delete the item
        $item->delete();

        return redirect()->route('dashboard')->with('success', 'Item deleted successfully');
    }

    public function filter(Request $request){
        $name = $request->input('name');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
    
        $query = Item::query();
        
        if ($name) {
            $query->where('name', 'like', "%$name%");
        }

        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
    
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }
    
        // Rest of the filtering logic
    
        $items = $query->get();
    
        return view('filtered', compact('items'));
    }

}
