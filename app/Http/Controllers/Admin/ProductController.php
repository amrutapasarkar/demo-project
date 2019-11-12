<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\ProductAttributeAssoc;
use App\ProductCategories;
use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $product = Product::where('product_name', 'LIKE', "%$keyword%")
            ->orWhere('product_price', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage);
        } else {
         
            $product = Product::with('category','product_Image','product_Attributes')->paginate($perPage);
            //dd($product);
        }

        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        $categories = Category::where('parent_id',0)->get();
        $allCategories = Category::where('parent_id',0)->get();
       
        return view('admin.product.create', compact('categories','allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProductRequest $request)
    {   
        
        $requestData = $request->all();

        $product = Product::create($requestData);
        //dd($product->id);
        $id= $product->id;

        $Pcategory= new ProductCategories;
        $Pcategory->product_id = $id;
        $Pcategory->category_id = $request->input('subcategory');
        $Pcategory->save();
        
        $productImage = $request->file('product_img');
        $productImageSaveAsName = time() . "-product." . $productImage->getClientOriginalExtension();
        $upload_path = 'product/';
        $product_image_url = $productImageSaveAsName;
        $success = $productImage->move($upload_path, $productImageSaveAsName);

        $Pimage = new ProductImage;
        $Pimage->product_id = $id;
        $Pimage->product_img = $product_image_url;
        $Pimage->save();

        $Pattributes = new ProductAttributeAssoc;
        $Pattributes->color = $request->input('color');
        $Pattributes->quantity = $request->input('quantity');
        $Pattributes->product_id = $id;
        $Pattributes->save();

        return redirect('admin/product')->with('flash_message', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::with('category','product_Image','product_Attributes')->findOrFail($id);

        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::with('category','product_Image','product_Attributes')->findOrFail($id);
        $categories = Category::where('id',$product->category->category_id)->get();
        $allCategories = Category::where('parent_id',0)->get();
        $subCategory = Category::get();

        return view('admin.product.edit', compact('product','categories','allCategories','subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        if ($request->hasFile('product_img')) {
            $requestData['product_img'] = $request->file('product_img')
            ->store('uploads', 'public');
        }

        $product = Product::findOrFail($id);
        $product->update($requestData);
        $cat = $request->input('subcategory');
        $subcategory = array('category_id'=>$cat);
        ProductCategories::where('product_id', $id)->update($subcategory);

        $prodattributes = array('color'=>$request->input('color'),'quantity'=>$request->input('quantity'));
        ProductAttributeAssoc::where('product_id', $id)->update($prodattributes);

        return redirect('admin/product')->with('flash_message', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('admin/product')->with('flash_message', 'Product deleted!');
    }    

}
