<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Models\Category;

class CategoryController extends Controller
{
    public function AllCategory(){
        $category = Category::latest()->get();
        return view('admin.backend.category.all_category', compact('category'));
    }

    public function AddCategory(){
        $category = Category::latest()->get();
        return view('admin.backend.category.add_category', compact('category'));
    }

    public function StoreCategory(Request $request){
        if($request->file('image')){
            $manager = new ImageManager(new Driver());
            $image_gen = hexdec(uniqid()).'.'.$request->file('image')->getClientOriginalExtension();
            $img = $manager->read($request->file('image'));
            $img = $img->resize(370,246);
            $img->toPng()->save(base_path('public/upload/category/'.$image_gen));
            $save_url = 'upload/category/'.$image_gen;


            Category::insert([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
                'image' => $save_url,
            ]);


            $notification = array(
                'message' => 'Catgeory Inserted Successfully',
                'alert-type' => 'success',


            );


            return redirect()->route('all.category')->with($notification);
         }

    }

    public function EditCategory($id){
        $category = Category::find($id);
        return view('admin.backend.category.edit_category', compact('category'));
    }
}
