<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ZipCode;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.products',compact('products'));
    }

    public function create(){
        $categories = Category::all();
        $zipcodes = ZipCode::all();
        return view('admin.add_product', compact('categories','zipcodes'));
    }

    public function store(Request $request){
        if ($request->hasfile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $name = $image->getClientOriginalName();
                $image->move('images/product_images', $name);
                $data[] = $name;
            }
        }
        $product = new Product();
        if ($request->hasFile('product_thumbnail')) {
            $file = $request->file('product_thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/product_images', $filename);
            $product->product_thumbnail = $filename;
        }
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->datasheet = $request->datasheet;
        $product->price = $request->price;
        $product->discounted_price = $request->discounted_price;
        $product->discount_in_percentage = (($product->price - $product->discounted_price)*100) /$product->price ;
        $product->size = $request->size;
        $product->gender = $request->gender;
        $product->color = $request->color;
        if(!empty(session()->get('attributes'))){
            $attribute_name = array();
            foreach(session()->get('attributes') as $item){
            $attribute_name[]= $item['name'];
            };
            $attribute_name_array = $attribute_name;
            $product->attribute_name = serialize($attribute_name_array);

            $attribute_values = array();
            foreach(session()->get('attributes') as $item){
            $attribute_values[]= $item['value'];
            };
            $attribute_value_array = $attribute_values;
            $product->attribute_values = serialize($attribute_value_array);
        }
        $product->delivery_charges = $request->delivery_charges;
        $product->delivery_time = $request->delivery_time;
        $product->zipcode = $request->zipcode;
        $product->product_images = json_encode($data);
        // dd($product);
        $product->save();
          $id = ZipCode::where('id', $request->zip_code_id)->first();
        $product->zip_codes()->attach($id);
        // Session::forget('attibutes');
        // return unserialize($product->attribute_values);
        return redirect()
            ->route('admin_products')
            ->with('success', 'Product has been added!');
    }

    public function edit($id){
        $categories = Category::all();
        $zipcodes = ZipCode::all();
        $product = Product::find($id);
        return view('admin.edit_product', compact('product', 'categories','zipcodes'));
    }

    public function update(Request $request,$id){
        $product = Product::find($id);
        if ($request->hasfile('product_images')) {
            // return ('abc');
            foreach ($request->file('product_images') as $image) {
                $name = $image->getClientOriginalName();
                $image->move('images/product_images', $name);
                $data[] = $name;
            }
        }

        if ($request->hasFile('product_thumbnail')) {
            $file = $request->file('product_thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/product_images', $filename);
            $product->product_thumbnail = $filename;
        }
        $product->name = $request->name;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->datasheet = $request->datasheet;
        $product->price = $request->price;
        $product->discounted_price = $request->discounted_price;
        $attribute_name = array();
        foreach(session()->get('attributes') as $item){
           $attribute_name[]= $item['name'];
        };
        $attribute_name_array = $attribute_name;
        $product->attribute_name = serialize($attribute_name_array);

        $attribute_values = array();
        foreach(session()->get('attributes') as $item){
           $attribute_values[]= $item['value'];
        };
        $attribute_value_array = $attribute_values;
        $product->attribute_values = serialize($attribute_value_array);
        $product->size = $request->size;
        $product->color = $request->color;
        $product->zipcode = $request->zipcode;
        $product->delivery_charges = $request->delivery_charges;
        $product->delivery_time = $request->delivery_time;
        $product->product_images = json_encode($data);
        // dd($product);
        $product->save();

        return redirect()
            ->route('admin_products')
            ->with('success', 'Product has been Updated!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        unlink('images/product_images/' . $product->product_thumbnail);

        Product::where('id', $product->id)->delete();

        return redirect()
            ->route('admin_products')
            ->with('danger', 'Produs has been deleted!');
    }
}
