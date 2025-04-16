<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    {
        $userCount = User::role('User')->count();
        $productCount = Product::count();
        return view("admin.dashboard", compact("userCount", "productCount"));    
    }
}
