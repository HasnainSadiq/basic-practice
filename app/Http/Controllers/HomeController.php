<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Brand;
use App\Models\Multipic;
use BaconQrCode\Renderer\Path\Move;
use Illuminate\Auth\Events\Login;
use illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function HomeSlider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    public function AddSlider()
    {
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request)
    {
            $validatedData = $request->validate(
         [
            'title',
            'description',
            'image',
         ],
         [
            'title.required' => 'plese input Title',
         ]);
        // $slider_image = $request->file('image');
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($slider_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/slider/';
        // $last_img = $up_location.$img_name;
        // $slider_image->move($up_location,$img_name);
         $slider_image = $request->file('image');
         $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
         Image::make($slider_image)->resize(1920, 1088)->save('image/slider/' . $name_gen);
         $last_img = 'image/slider/' . $name_gen;
         Slider::create([
             'title' => $request->title,
             'description' => $request->description,
             'image' => $last_img,
         ]);
         return redirect()->route('home.slider')->with('success','Slider Insertd Succesfully');

    }

    public function Edit($id)
    {
        $sliders = Slider::find($id);
        return view('admin.slider.edit',compact('sliders'));
    }

    public function update(Request $request , $id)
    {
        $old_image = $request->old_image;
        $slider_image = $request->file('image');
        if ($slider_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($slider_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/slider/';
            $last_img = $up_location . $img_name;
            $slider_image->move($up_location, $img_name);
            unlink($old_image);
            Slider::find($id)->Update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
            ]);

            return redirect()->back()->with('success', 'Slider Update Succesfully');
        }  else {
            Slider::find($id)->Update([
                'title' => $request->title,
            ]);

            return redirect()->back()->with('success', 'Slider Update Succesfully');
        }

    }

    public function Delete($id)
    {
        $image = Slider::find($id);
        $old_image = $image->image;
        $delete = Slider::find($id)->delete();
        if ($delete) {
            unlink($old_image);

            return redirect()->back()->with('success', 'Slider delete Succesfully');
        } else {
            return redirect()->back()->with('error', 'Somthing went wrong');
        }
    }

}
