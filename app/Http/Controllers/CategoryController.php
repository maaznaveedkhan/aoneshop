<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function create_category(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        $category = new Category();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/category_images', $filename);
            $category->image = $filename;
        }
        $category->title = $request->title;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('admin_categories')->with('success', 'Category has been added!');

    }

    public function delete_category($id){

        $category = Category::find($id);
        $image = 'images/category_images/' . $category->image;
        $category->delete();
        unlink($image);
        return redirect()->back()->with('success','Category has been deleted!');
    }

    public function update_category($id, Request $request){

        $category = Category::find($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/category_images', $filename);
            $category->image = $filename;
        }
        $category->title = $request->title;
        $category->descriptions = $request->description;

        $category->save();

        return redirect()->route('admin_categories')->with('success', 'Category has been updated!');

    }
}


