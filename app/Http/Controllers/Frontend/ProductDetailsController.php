<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\ProductImage;
use DB;

class ProductDetailsController extends Controller
{
    /**
     * Display a product details.
     *
     * @return \Illuminate\View\View
     */
    public function ShowProductDetails(Request $request){
        $category = Category::where('parent_id','0')->get();
        $categories = Category::with('parent')->get();
        $subcategory = DB::table('categories')->get();
        $product = DB::table('categories')
        ->join('product_category', 'product_category.category_id','=', 'categories.id')
        ->join('product', 'product.id', '=', 'product_category.product_id')
        ->join('product_img', 'product_img.product_id', '=', 'product.id')
        ->join('product_attribute_assoc', 'product_attribute_assoc.product_id', '=', 'product.id')
        ->where('product.id',$request->id)
        ->get();
        
        return view('Eshopper.product-details',compact('product','category','categories','subcategory'));
    }
}
