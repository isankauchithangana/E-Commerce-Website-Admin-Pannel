<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\emplooyees; 
use Illuminate\Support\Facades\Hash; 


class UserController extends Controller
{
    public function createUser()
    {
        return view('admin_register');
    }

    public function save(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'NIC' => 'required|string|max:20|unique:emplooyees,NIC', // Ensure NIC is unique
            'email' => 'required|string|email|max:255|unique:emplooyees,email', // Ensure email is unique
            'password' => 'required|string|min:3|confirmed', // Ensure password matches confirmation
        ]);

        // Create the new employee record
        emplooyees::create([
            'firstName' => $validatedData['fname'],
            'lastName' => $validatedData['lname'],
            'NIC' => $validatedData['NIC'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'userRole' => 'Super Admin',
            'address' => $request->input('address', 'default address'), 
            'pNo' => $request->input('pNo', null), 
            'joinDate' => $request->input('joinDate', now()), 
        ]);

        // Redirect or return a success response
        return redirect()->back()->with('success', 'Super Admin registered successfully!');
    }
}
