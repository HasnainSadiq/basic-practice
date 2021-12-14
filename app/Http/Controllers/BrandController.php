<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use BaconQrCode\Renderer\Path\Move;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
// use Image;

use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        // dd($brands);
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:2',
                'brand_image' => 'required',
            ],
            [
                'brand_name.required' => 'Please input Brand Name',
                'brand_name.min' => 'Brand Longer then 4 chracter',
            ]
        );

        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location,$img_name);

        $name_gen = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
        $test = Image::make($brand_image)->resize(300, 200)->save('image/brand/' . $name_gen);
        // $test=Image::make($request->file('brand_image')->getRealPath());
        // dd($test);
        // Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
        $last_img = 'image/brand/' . $name_gen;
        Brand::create([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            //    'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Brand inserted Succesfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function Edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'brand_name' => 'required|min:2',
            ],
            [
                'brand_name.required' => 'Please input Brand Name',
                'brand_name.min' => 'Brand Longer then 4 chracter',
            ]
        );

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');
        if ($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location . $img_name;
            $brand_image->move($up_location, $img_name);
            unlink($old_image);
            Brand::find($id)->Update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img
            ]);

            $notification = array(
                'message' => 'brand Update Succesfully',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);
        } else {
            Brand::find($id)->Update([
                'brand_name' => $request->brand_name,
            ]);

            $notification = array(
                'message' => 'Brand update Succesfully',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function Delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        $delete = Brand::find($id)->delete();
        if ($delete) {
            unlink($old_image);
            $notification = array(
                'message' => 'Brand Delete Succesfully',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Somthing went wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }



    //This is for multiimage all method
    public function Multimage()
    {
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }



    public function StoreImg(Request $request)
    {
        $validatedData = $request->validate(
            [
                'image' => 'required',
            ]
        );
        $image = $request->file('image');

        foreach ($image as $multi_image) {
            $name_gen = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
            Image::make($multi_image)->resize(200, 200)->save('image/multi/' . $name_gen);

            $last_img = 'image/multi/' . $name_gen;
            Multipic::create([
                'image' => $last_img,
            ]);
        } //End foreach
        return redirect()->back()->with('success', 'Multi pictures Inserted Succesfully');
    }

    public function Logout()
    {
        Auth::logout();
        return Redirect('/')->with('succsess','User Logout');
    }
    // public function Register()
    // {
    //     // dd('here');
    //     Auth::Register();
    //     return Redirect()->route('register')->with('success','User Register');
    // }
}
