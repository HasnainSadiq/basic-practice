<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function HomeAbout()
    {
        $homeabout = HomeAbout::latest()->get();
        return view('admin.home.index',compact('homeabout'));
    }

    public function AddAbout()
    {
        return view('admin.home.create');
    }

    public function StoreAbout(Request $request)
    {
        HomeAbout::create([
            'title' => $request->title,
            'short_discription' => $request->short_discription,
            'long_discription' => $request->long_discription,
        ]);
        return redirect()->route('home.about')->with('success','About Inserted succesfully');
    }

    public function Edit($id)
    {
        $homeabout = HomeAbout::find($id);
        return view('admin.home.edit',compact('homeabout'));
    }

    public function Update(Request $request , $id)
    {
        // dd($request->all());
            $update = HomeAbout::find($id);
            $update->title=$request->title;
            $update->short_discription=$request->short_discription;
            $update->long_discription=$request->long_discription;
            $update->save();

            // $update->update([
            //     'title' => $request->title,
            //     'short_discription	' => $request->short_discription,
            //     'long_discription	' => $request->long_discription,
            // ]);
        return redirect()->route('home.about')->with('success','About update succesfully');
    }

    public function Delete($id)
    {
        $delete = HomeAbout::find($id)->delete();
        return redirect()->back()->with('success','About Home Permentaly Delete');

    }
    public function Portfolio()
    {
        $images = Multipic::all();
        return view('pages.portfolio',compact('images'));
    }

}
