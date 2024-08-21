<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\emplooyees;

class EmployeeController extends Controller
{
    public function create()
    {
        $user = Auth::user(); // Retrieve the authenticated user

        $adminCount = emplooyees::where('userRole', 'Super Admin')->count();
        $storeManagerCount = emplooyees::where('userRole', 'Store Manager')->count();
        $contentEditorCount = emplooyees::where('userRole', 'Content Editor')->count();
        $deliveryPersonCount = emplooyees::where('userRole', 'Delivery Personal')->count();

        $employees = emplooyees::all();

        return view('create_users', compact(
            'user',
            'adminCount', 
            'storeManagerCount', 
            'contentEditorCount', 
            'deliveryPersonCount', 
            'employees'
        ));
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'nic' => 'required|string|max:20|unique:emplooyees,NIC',
            'address' => 'required|string|max:255',
            'pNo' => 'required|string|max:15',
            'joinDate' => 'required|date',
            'role' => 'required|string',
            'email' => 'required|email|max:255|unique:emplooyees,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        // Create a new employee using the validated data
        emplooyees::create([
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'NIC' => $validatedData['nic'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'userRole' => $validatedData['role'],
            'address' => $request->input('address', 'default address'), // Default address if not provided
            'pNo' => $request->input('pNo', null), // Default to null if not provided
            'joinDate' => $request->input('joinDate', now()), // Default to current date-time
        ]);
    
        // Redirect to the create user page with a success message
        return redirect()->route('create_user')->with('success', 'User created successfully.');
    }
    
}
