<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Slider;
use App\Models\ZipCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function adminLogin()
    {
        return view('admin.auth.login');
    }
    public function adminRegister()
    {
        return view('admin.auth.register');
    }
    public function adminLoginData(Request $request )
    {
        // return $request;
        $input = $request->all();
        $this->validate($request, [
            'email'=>'required',
            'password'=> 'required',
        ]);
        $checker =  Auth::guard('admin')->attempt(['email'=>$input['email'], 'password'=>$input['password']]);

        if($checker){
            return redirect()->route('admin_dashboard')->with('success', 'Your Loggedin as Admin Successfullly');
        }else{
            return redirect()->back()->with('success', 'wrong credentials please try again');
        }
    }
    public function adminDashboard()
    {
        //  return Auth::guard('admin')->user()->name;
      return  view('admin.admindashboard');
    }
    public function adminLogout()
    {
        Auth::guard('admin')->logout();

        return redirect('/');
    }
    public function adminRegisterData(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|unique:admins',
            'password'=> 'required|confirmed',
        ]);
        $user = new Admin();
        $user->email= $input['email'];
        $user->name= $input['name'];
        $user->password = Hash::make($input['password']);
        $user->save();


      Auth::guard('admin')->login($user);
        return redirect()->route('admin_dashboard')->with('success', 'You are loggedin  as Admin successfull ');

    }

    public function edit_profile($id){
        $admin = Admin::find($id);
        return view('admin.profile',compact('admin'));
    }

    

    public function admin_dashboard(){
        return view('admin.admindashboard');
    }

    public function admin_sliders(){
        $sliders = Slider::all();
        return view('admin.sliders',compact('sliders'));
    }

    public function add_slider(Request $request){
        $slider = new Slider();
        if ($request->hasFile('slider')) {
            $file = $request->file('slider');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/slider_images', $filename);
            $slider->slider = $filename;
        }

        $slider->save();

        return redirect()->route('admin_slider')->with('success','Slider has been added!');
    }

    public function zipcodes(){
        $zipcodes = ZipCode::all();
        return view('admin.zipcodes',compact('zipcodes'));
    }

    public function add_zipcode(Request $request){
        $zipcode = new ZipCode();
        $zipcode->zipcode = $request->zipcode;
        $zipcode->save();

        return redirect()->back()->with('success', 'Zipcode has been added!');
    }
}
