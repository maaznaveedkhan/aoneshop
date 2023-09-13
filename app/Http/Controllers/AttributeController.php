<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeController extends Controller
{
    public function attribute_form(){
        // $session_data = Session::get();
        return view('admin.add_attributes');

    }

    public function setData(Request $request){
        $data = [
            'name' => $request->attr_name,
            'value' => $request->attribute_values
        ];
        $attributes = array();
        $attributes = session()->get('attributes');
        $attributes[] = $data;
        // $attributes[] = $data;

        Session::put('attributes',$attributes);
      return redirect()->route('new_product')->with('success','Attributes');
    //   return response()->json(['session successfully saved']);
    }
}
