<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Product;
use App\Models\Review;
use App\Models\Customer;
use App\Models\Orders;

class AdminController extends Controller
{
    public function dashboard()
    {
        $inquiriesCount = Tickets::count();
        $productsCount = Product::count();
        $reviewsCount = Review::count();
        $customersCount = Customer::count();
        $orderCount = Orders::count();
    
        return view('admin.dashboard', compact('inquiriesCount', 'productsCount', 'reviewsCount','customersCount','orderCount'));
    }
    
}
