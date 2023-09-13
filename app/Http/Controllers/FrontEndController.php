<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\ZipCode;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function searchProductsResults(Request $request)
    {
        $result = null;

        if($request->ajax()){
            $q = trim($request->data);

          $products = Product::where('name', 'LIKE','%'.$q.'%')
          ->orWhere('short_description',  'LIKE','%'.$q.'%')->orWhere('long_description', 'LIKE','%'.$q.'%')->distinct('id')->get();
            if(strlen($q) != 0){
            foreach($products as $pro){
                $image = asset('images/product_images/'.$pro->product_thumbnail);
                $link = route('view.product.details', ['id' => $pro->id]);
                $result = $result .'<div class=" list-group  d-flex justify-content-between" ><a href="'.$link.'" class=" list-group-item list-group-item-action list-group-item-light d-flex justify-content-between align-items-center"><span class=""><img src="'.$image.'" style="height:26px;widht:50px;object-fit:cover;">'.$pro->name.'</span>  <i class="fa text-right fa-external-link" aria-hidden="true"></i></a> </div>';
            }
        }else{
            return null;
        }
            return $result;
        }else{
            $q = trim($request->data);
            $products = Product::where('name', 'LIKE','%'.$q.'%')
            ->orWhere('short_description',  'LIKE','%'.$q.'%')->orWhere('long_description', 'LIKE','%'.$q.'%')->distinct('id')->get();
            if(count($products) !=0){
                $result = $products;
                return view('frontend.search', compact( 'result'));
            }else{
                $result = 'Available Comming Soon';
                return view('frontend.search', compact( 'result'));
            }

        }
    }
    public function address (Request $request)
    {
        $address = $request->address;
        session()->put('address', $address);
        return redirect()->back()->with('success', 'your address has been updated successfully!');
    }
    public function viewCategory($id)
    {
        $products = Product::where('category_id', $id)->get();

        return view('frontend.singleCategory', compact('products'));
    }
    public function allCategories()
    {
        $categories = Category::all();
        return view('frontend.allCategories', compact('categories'));
    }
    public function viewProductDetails($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::findOrFail($product->category_id);
        $zip_codes = ZipCode::with('products')->where('id', $product->zip_code_id)->first();
       return view('frontend.productDetails', compact('product', 'zip_codes', 'category'));
    }
    public function searchZipCodes(Request $request)
    {
        $result = 'Available Comming Soon';
       $zip_code =  $request->zip_code;
       $zip_code = ZipCode::where('zipcode', $zip_code)->first();
       $zipcodes = Product::where('zipcode', $zip_code->id)->get();

         //    return $zipcodes->products;
        // $products->zip_codes()->attach($zipcodes);
        if($zipcodes ==null){

            return view('frontend.search', compact('result'));
        }else{
            $result = $zipcodes;
            return view('frontend.search', compact('result'));
        }

    }
    public function checkout(Request $request)
    {

        return view('frontend.checkout');
    }

    public function HomePage()
    {
        $sliders = Slider::all();
        // return $sliders->count();
        $products = Product::latest()->paginate(12);
        $categories = Category::latest()->paginate(12);




        return view('welcome', compact('sliders', 'products', 'categories'));

    }



    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        // return 'from cart';

        return view('frontend.cart');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {

        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        $price = 0;
        if($product->discounted_price == null){
            $price = $product->price;
        }else {
            $price = $product->discounted_price;
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => 'images/product_images/'. $product->product_thumbnail,
                'delivery_charges' => $product->delivery_charges,
            ];
        }


        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        // return $request->quantity;
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

}
