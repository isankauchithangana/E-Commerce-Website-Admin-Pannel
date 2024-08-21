<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\users;
use App\Models\items;
use App\Models\carts;


class OrderController extends Controller
{
    public function show($id)
    {
        $cartData = DB::table('carts')
            ->join('items', 'carts.itemID', '=', 'items.itemId')
            ->join('users', 'carts.userID', '=', 'users.id')
            ->where('carts.cartID', '=', $id)
            ->select(
                'carts.cartID',
                'users.id as userID',
                'users.name',
                'users.address',
                'users.nic',
                'users.email',
                'items.itemName',
                'items.itemId',
                'carts.quantity',
                'items.price',
                'carts.status'
            )
            ->first();

            $user = Auth::user();


        return view('view_order', [
            'cartData' => $cartData,
            'user' => $user
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'cartID' => 'required|integer',
            'status' => 'required|string'
        ]);

        // Update the status of the cart
        DB::table('carts')
            ->where('cartID', $request->input('cartID'))
            ->update(['status' => $request->input('status')]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

}
