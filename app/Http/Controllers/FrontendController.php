<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    public function index($username)
    {
        // Log the username for debugging
        Log::info("FrontendController::index called with username: {$username}");

        // Find the store by username and eager-load product categories
        $store = User::where('username', $username)
                     ->with('productCategories')
                     ->first();

        if (!$store) {
            Log::warning("Store not found for username: {$username}");
            abort(404);
        }

        // Fetch popular products with product category relationship
        $populars = Product::where('user_id', $store->id)
                           ->where('is_popular', true)
                           ->with('productCategory')
                           ->get();

        // Fetch recommended products with product category relationship
        $products = Product::where('user_id', $store->id)
                           ->where('is_popular', false)
                           ->with('productCategory')
                           ->get();

        // Log data counts for debugging
        Log::info("Store: {$store->name}, Populars count: {$populars->count()}, Products count: {$products->count()}");

        return view('pages.index', compact('store', 'populars', 'products'));
    }
}