<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\Category;

class ProductController extends Controller
{
    //index
    public function index(Request $request)
    {
        $products = Product::when($request->keyword, function ($query) use ($request){
            $query->where('name', 'like', "%{$request->keyword}%")
            ->orWhere('description', 'like',  "%{$request->keyword}%");
        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.products.index', compact('products'));
    }

    //create
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('pages.products.create', compact('categories'));
    }


    //store
    public function store(Request $request)
    {
        $request->validate([
            'category_id'=> 'required',
            'name'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
            'image'=> 'required',
            'criteria'=> 'required',
            'favorite'=> 'required',
            'status'=> 'required',
            'stock'=> 'required',
        ]);

      $product =new Product;
      $product->category_id = $request->category_id;
      $product->name = $request->name;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->image = $request->image;
      $product->criteria = $request->criteria;
      $product->favorite = $request->favorite;
      $product->status = $request->status;
      $product-> stock = $request->stock;
      $product->save();

      //image
      $image =$request->file('image');
      $image->storeAs('public/products', $product->id . '.' .$image->extension());
      $product->image ='products/'. $product->id . '.' . $image->extension();
      $product->save();

    return redirect()->route('products.index')->with('success', 'Product created sucessfully');
    }

    //edit
    public function edit (Product $product)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('pages.products.edit',compact('product', 'categories'));
    }
    //updatae
    public function update(Request $request, Product $product)
    {
      $product->category_id = $request->category_id;
      $product->name = $request->name;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->image = $request->image;
      $product->criteria = $request->criteria;
      $product->favorite = $request->favorite;
      $product->status = $request->status;
      $product-> stock = $request->stock;


      //check if image is not empty
      if ($request->image){
      $image =$request->file('image');
      $image->storeAs('public/products', $product->id . '.' .$image->extension());
      $product->image ='products/'. $product->id . '.' .$image->extension();
    }
      return redirect()->route('products.index')->with('success', 'Product created sucessfully');

    }
    //destory
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}

