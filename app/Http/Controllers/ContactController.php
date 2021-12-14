<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationData;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function AdminContact()
    {
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }


    public function AddContact()
    {
        return view('admin.contact.create');
    }




    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'address',
                'email',
                'phone',
            ]);
            Contact::create([
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        return redirect()->route('admin.contact')->with('success','Data Add  succesfully');
    }

    public function Edit($id)
    {
        $cont = Contact::find($id);
        return view('admin.contact.edit',compact('cont'));
    }

    // public function Update(Request $request , $id)
    // {
    //     $update = Contact'::find($id);
    //     $update->address=$request->address;
    //     $update->email=$request->email;
    //     $update->phone=$request->phone;
    //     $update->save();
    //         return redirect();
    // }


    public function Update(Request $request , $id)
    {
            $update = Contact::find($id);
            $update->address=$request->address;
            $update->email=$request->email;
            $update->phone=$request->phone;
            $update->save();
        return redirect()->route('admin.contact')->with('success','contact update succesfully');
    }

    public function Delete($id)
    {
        $delete = Contact::find($id)->delete();
        return redirect()->route('admin.contact')->with('success','Contact Delete succesfully');

    }

    public function Contact()
    {
        $contacts = DB::table('contacts')->first();
        return view('pages.contact',compact('contacts'));
    }

    public function contForm(Request $request)
    {
        ContactForm::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,

        ]);
    return redirect()->route('contact')->with('success','Your Message Send succesfully');
    }

    public function AdminMessage()
    {
        $messages = ContactForm::all();
        return view('admin.contact.message',compact('messages'));
    }

    public function MessageDelete($id)
    {
        $delete = ContactForm::find($id)->delete();
        return redirect()->route('admin.message')->with('success','Message Delete succesfully');
    }
}
