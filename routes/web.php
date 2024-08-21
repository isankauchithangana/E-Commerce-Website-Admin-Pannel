<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Models\emplooyees;
use App\Models\users;
use App\Models\cart;
use App\Models\items;
use Illuminate\Support\Facades\DB;



Route::get('/', function () {
    return view('user_login');
});

Route::controller(UserController::class)->group(function (){
    Route::get('/createUser','createUser');
    Route::post('/saveAdmin','save')->name('admin.save');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Protecting the dashboard route with auth middleware
Route::middleware(['web'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user) {
            $customerCount = users::count();

            $newOrdersCount = DB::table('carts')
                    ->where('carts.status', 'ORDERED')
                    ->count();

            $onShippingOrdersCount = DB::table('carts')
                    ->where('carts.status', 'On Shipping')
                    ->count();
            

            $orders = DB::table('carts')
                ->join('items', 'carts.itemID', '=', 'items.itemID')
                ->select('items.itemName', 'items.price', 'items.shipping')
                ->where('carts.status', 'ORDERED')
                ->get();
            $customers = users::all();
            return view('index', [
                'user' => $user,
                'customerCount' => $customerCount,
                'newOrdersCount' => $newOrdersCount,
                'onShippingOrdersCount' => $onShippingOrdersCount,
                'orders' => $orders,
                'customers' => $customers
            ]);

        } else {
            return redirect('/login')->with('error', 'Please log in first.');
        }
    })->name('dashboard');


        Route::get('/orders', function () {
            $user = Auth::user();
    
            if ($user) {
                $newOrdersCount = DB::table('carts')
                    ->where('carts.status', 'ORDERED')
                    ->count();
                
                $processingOrdersCount = DB::table('carts')
                    ->where('carts.status', 'Processing')
                    ->count();

                $onShippingOrdersCount = DB::table('carts')
                    ->where('carts.status', 'On Shipping')
                    ->count();

                $deliveredOrdersCount = DB::table('carts')
                    ->where('carts.status', 'Delivered')
                    ->count();

                $orders = DB::table('carts')
                ->join('items', 'carts.itemID', '=', 'items.itemId')
                ->join('users', 'carts.userID', '=', 'users.id')
                ->select(
                    'carts.cartID',
                    'users.name',
                    'users.id as userID',
                    'items.itemName',
                    'items.price',
                    'users.address',
                    'carts.quantity',
                    'carts.status'
                )
                ->whereIn('carts.status', ['ORDERED', 'Processing', 'On Shipping', 'Delivered'])
                ->get();
    
                return view('orders', [
                    'user' => $user,
                    'newOrdersCount' => $newOrdersCount,
                    'processingOrdersCount' => $processingOrdersCount,
                    'onShippingOrdersCount' => $onShippingOrdersCount,
                    'deliveredOrdersCount' => $deliveredOrdersCount,
                    'orders' => $orders
                ]);
            } else {
                return redirect('/login')->with('error', 'Please log in first.');
            }
        })->name('orders'); 

        Route::get('/employees', function () {
            $user = Auth::user();
    
            if ($user) {
                $adminCount = DB::table('emplooyees')
                    ->where('emplooyees.userRole', 'Super Admin')
                    ->count();
                
                $storeManagerCount = DB::table('emplooyees')
                    ->where('emplooyees.userRole', 'Store Manager')
                    ->count();

                $contentEditorCount = DB::table('emplooyees')
                    ->where('emplooyees.userRole', 'Content Editor')
                    ->count();

                $deliveryPersonalCount = DB::table('emplooyees')
                    ->where('emplooyees.userRole', 'Delivery Personal')
                    ->count();

                $employees = DB::table('emplooyees')
                ->select(
                    'emplooyees.userId',
                    'emplooyees.firstName',
                    'emplooyees.lastName',
                    'emplooyees.NIC',
                    'emplooyees.address',
                    'emplooyees.pNo',
                    'emplooyees.joinDate',
                    'emplooyees.email',

                )
                ->get();
    
                return view('view_users', [
                    'user' => $user,
                    'adminCount' => $adminCount,
                    'storeManagerCount' => $storeManagerCount,
                    'contentEditorCount' => $contentEditorCount,
                    'deliveryPersonalCount' => $deliveryPersonalCount,
                    'employees' => $employees
                ]);
            } else {
                return redirect('/login')->with('error', 'Please log in first.');
            }
        })->name('employess'); 



        Route::get('/customers', function () {
            $user = Auth::user();
    
            if ($user) {
                
                $customerCount = DB::table('users')
                    ->count();

                $customers = DB::table('users')
                ->select(
                    'users.id as userID',
                    'users.name',
                    'users.nic',
                    'users.address',
                    'users.email'
                )
                ->get();
    
                return view('customers', [
                    'user' => $user,
                    'customerCount' => $customerCount,
                    'customers' => $customers
                ]);
            } else {
                return redirect('/login')->with('error', 'Please log in first.');
            }
        })->name('customers'); 

        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        Route::get('/products', function () {
            $user = Auth::user();
    
            if ($user) {
                
                $productCount = DB::table('items')
                    ->count();

                $products = DB::table('items')
                ->join('brands', 'items.brandID', '=', 'brands.brandID')
                ->join('categories', 'items.categoryID', '=', 'categories.categoryID')
                ->join('images', 'items.imageID', '=', 'images.imageID')
                ->select(
                    'items.itemId',
                    'items.itemName',
                    'items.price',
                    'items.origin',
                    'items.shipping',
                    'items.availableFrom',
                    'items.availableTo',
                    'items.brandID',
                    'items.categoryId',
                    'brands.brandName',
                    'categories.categoryName',
                    'images.imagePath'
                )
                ->get();
    
                return view('products', [
                    'user' => $user,
                    'productCount' => $productCount,
                    'products' => $products
                ]);
            } else {
                return redirect('/login')->with('error', 'Please log in first.');
            }
        })->name('products'); 

        Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/product/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
        Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

        Route::post('/images/upload', [ProductController::class, 'uploadImage'])->name('image.upload');
        Route::get('/product/select-image/{itemID}', [ProductController::class, 'selectImage'])->name('product.selectImage');
        Route::post('/products/save-image', [ProductController::class, 'saveImageSelection'])->name('product.saveImageSelection');

        Route::get('/create_user', [EmployeeController::class, 'create'])->name('create_user');
        Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');



});

