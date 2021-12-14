<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function AllCat()
    {
        //Elequent ORM
        $categories = Category::latest()->paginate(5);
        $trachCat = Category::onlyTrashed()->latest()->paginate(3);

        //Query Builder
        // $categories = DB::table('categories')->latest()->paginate(5);

        //    $categories = DB::table('categories')
        //    ->join('users', 'categories.user_id','users.id')
        //    ->select('categories.*','users.name')
        //    ->latest()->paginate(5);
        return view('admin.category.index',compact('categories','trachCat'));
    }

    public function AddCat(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please input category Name',
            'category_name.max' => 'category less than 255 chars',
        ]);
            // Elequent ORM
            // Category::insert([
            //     'category_name' => $request->category_name,
            //     'user_id' => Auth::user()->id,
            //     'created_at' => Carbon::now(),
            // ]);


            $category = new Category;
            $category->category_name = $request->category_name;
            $category->user_id = Auth::user()->id;
            $category->save();

            //Insertd data with Query Builder
            //   $data = array();
            //   $data  ['category_name']  = $request->category_name;
            //   $data  ['user_id'] = Auth::user()->id;
            //   DB::table('categories')->insert($data);

            return redirect()->back()->with('success','Category inserted successfully');
    }

    public function Edit($id)
    {
        //Elequent ORM Method
        // $categories = Category::find($id);
        // return view('admin.category.edit',compact('categories'));

        //Query Builder
        $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));
    }

    public function Update(Request $request ,$id)
    {
        //Elequent ORM Method
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        // ]);
        // return redirect()->route('all.category')->with('success','Category Update successfully');


        //Query Builder

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);
        return redirect()->route('all.category')->with('success','Category Update successfully');

    }

    public function SoftDelete($id)
    {
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success','Category SOft-Delete successfully');

    }

    public function Restore($id)
    {
        $delete = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Category Restore Successfully');

    }

    public function PDelete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Category Permentaly Delete');

    }
}





