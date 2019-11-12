<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use App\Category;
use App\Product;
use App\ProductImage;
use App\ProductAttributeAssoc;
use DB;

class DashboardController extends Controller
{

    /**
     * Display a product details.
     *
     * @return \Illuminate\View\View
     */
    public function showDashboard(){

    	$banner = Banner::get();
    	$category = Category::where('parent_id','0')->get();
        $categories = Category::with('parent')->get();
        $subcategory = DB::table('categories')->get();
        $product = DB::table('categories')
        ->join('product_category', 'product_category.category_id', '=', 'categories.id')
        ->join('product', 'product.id', '=', 'product_category.product_id')
        ->join('product_img', 'product_img.product_id', '=', 'product.id')
        ->join('product_attribute_assoc', 'product_attribute_assoc.product_id', '=', 'product.id')
        ->get();
        return view('Eshopper.dashboard',compact('banner','product','category','categories','subcategory'));
    }

    /**
     * Display a categories and subcategories.
     *
     * @return \Illuminate\View\View
     */
    public function categories()
    {
        $category = Category::where('parent_id','0')->get();
        $categories = Category::with('parent')->get();
        $subcategory = DB::table('categories')->get();
        $product = DB::table('categories')
        ->join('product_category', 'product_category.category_id', '=', 'categories.id')
        ->join('product', 'product.id', '=', 'product_category.product_id')
        ->join('product_img', 'product_img.product_id', '=', 'product.id')
        ->join('product_attribute_assoc', 'product_attribute_assoc.product_id', '=', 'product.id')
        ->get();

        return view('Eshopper.productinfo', compact('product','category','categories','subcategory'));

    }

     /**
     * Display a products with details.
     *
     * @return \Illuminate\View\View
     */
     public function product(Request $request)
     {   

        $category = Category::where('parent_id','0')->get();
        $categories = Category::with('parent')->get();
        $subcategory = DB::table('categories')->get();
        $id = $request->id; 
        $product = DB::table('categories')
        ->join('product_category', 'product_category.category_id', '=', 'categories.id')
        ->join('product', 'product.id', '=', 'product_category.product_id')
        ->join('product_img', 'product_img.product_id', '=', 'product.id')
        ->join('product_attribute_assoc', 'product_attribute_assoc.product_id', '=', 'product.id')
        ->where('categories.id', '=', $id)
        ->get();

        return view('Eshopper.productinfo', compact('product','category','categories','subcategory'));

    }
}
