<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\users;
use App\Models\items;
use App\Models\images;
use App\Models\brands;
use App\Models\categories;

class ProductController extends Controller
{
    public function show($id)
    {
        $productData = DB::table('items')
            ->join('brands', 'items.brandID', '=', 'brands.brandID')
            ->join('categories', 'items.categoryID', '=', 'categories.categoryID')
            ->join('images', 'items.imageID', '=', 'images.imageID')
            ->where('items.itemId', '=', $id)
            ->select(
                'items.itemId',
                'items.itemName',
                'items.price',
                'items.origin',
                'items.shipping',
                'items.availableFrom',
                'items.availableTo',
                'brands.brandName',
                'categories.categoryName',
                'images.imagePath'
            )
            ->first();

        $user = Auth::user();

        return view('view_product', [
            'productData' => $productData,
            'user' => $user
        ]);
    }

    public function editProduct($id)
    {
        $itemData = items::with('category', 'brand', 'image')
            ->where('itemId', $id)
            ->first();

        $categories = categories::all();
        $brands = brands::all();
        $images = images::all();
        $user = Auth::user(); // Get the authenticated user

        return view('edit_product', compact('itemData', 'categories', 'brands', 'user','images'));
    }

    public function update(Request $request, $id)
    {
        // Find the item by itemId
        $item = items::where('itemId', $id)->firstOrFail();

        $validatedData = $request->validate([
            'itemName' => 'nullable|string|max:255',
            'brandID' => 'nullable|exists:brands,brandID',
            'categoryID' => 'nullable|exists:categories,categoryID',
            'origin' => 'nullable|string|max:255',
            'availableFrom' => 'nullable|date',
            'availableTo' => 'nullable|date',
            'price' => 'nullable|numeric',
            'shipping' => 'nullable|string|in:Free,Paid',
        ]);

        $item->update(array_filter($validatedData));

        return redirect()->route('product.edit', $item->itemId)->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $item = items::where('itemId', $id)->firstOrFail();

        // Delete the item
        $item->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully.');
    }



    public function create()
    {
        $brands = brands::all();
        $categories = categories::all();
        $user = Auth::user();
        return view('new_product', compact('brands', 'categories', 'user'));
    }

    // Handle the form submission
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'itemName' => 'required|string|max:255',
            'brandID' => 'required|integer',
            'price' => 'required|numeric',
            'categoryID' => 'required|integer',
            'origin' => 'required|string|max:255',
            'shipping' => 'required|string|max:255',
            'availableFrom' => 'required|date',
            'availableTo' => 'required|date',
            'imageID' => 'nullable|integer|exists:images,imageID', 
        ]);
        dd($validated);

    
        // Create the new item
        $newItem = items::create([
            'itemName' => $validated['itemName'],
            'brandID' => $validated['brandID'],
            'price' => $validated['price'],
            'categoryID' => $validated['categoryID'],
            'origin' => $validated['origin'],
            'shipping' => $validated['shipping'],
            'availableFrom' => $validated['availableFrom'],
            'availableTo' => $validated['availableTo'],
            'imageID' => $validated['imageID'] ?? null, 
        ]);
        dd($newItem);

        // Redirect to the image gallery to select an image for this product
        return redirect()->route('product.selectImage', ['itemID' => $newItem->itemId]);
    }
    

    public function selectImage($itemID)
    {
        $images = DB::table('images')->get();
        return view('image_gallery', compact('images', 'itemID'));
    }

    public function saveImageSelection(Request $request)
    {
        $validatedData = $request->validate([
            'itemID' => 'required|integer|exists:items,itemId',
            'imageID' => 'required|integer|exists:images,imageID',
        ]);

        // Update the item's imageID with the selected image
        $item = items::findOrFail($validatedData['itemID']);
        $item->imageID = $validatedData['imageID'];
        $item->save();

        return redirect()->route('product.show', ['id' => $item->itemId])->with('success', 'Product image updated successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'fileInput.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $uploadedImages = [];
        foreach ($request->file('fileInput') as $image) {
            $path = $image->store('images', 'public');
            $uploadedImages[] = DB::table('images')->insertGetId([
                'imagePath' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Images uploaded successfully!');
    }


}
