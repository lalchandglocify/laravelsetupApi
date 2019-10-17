<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $userDetails = Auth::user();
        return view('home',compact('userDetails'));
    }
    
    public function home(Request $request){
        $userDetails = Auth::user();
        if($userDetails->user_type == 'admin'){
            return redirect('userList'); 
        }
        else{
            return redirect('dashboard');
        }
    } 

    public function contact(Request $request){
        $userDetails = Auth::user();
        $title = ['title'=>'Contact'];
        if(!empty($request->all())){
            $request->validate([
                'name'=>'required',
                'email'=>'required',
                'subject'=>'required',
                'phone_number'=>'required',
                'message'=>'required',
            ]);

            $contact = Contact::create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'subject'=>$request->input('subject'),
                'phone_number'=>$request->input('phone_number'),
                'message'=>$request->input('message')
            ]);
            if(!$contact){
                return back()->with('error','Something went wrong.');
            }
            else{
                return back()->with('success','Form submitted successfully. Our team will contact you shortly.');
            }
        }
        return view('contact',compact('title','userDetails'));
    }

    public function terms(Request $request){
        $userDetails = Auth::user();
        $title = ['title'=>'Terms of Service'];
        $terms = Term::get();
        return view('terms',compact('title','terms','userDetails'));
    }

    public function howItWorks(){
        $userDetails = Auth::user();
        $title = ['title'=>'How it Works'];
        return view('howItWorks',compact('title','userDetails'));
    }

    public function inspectionSoftware(Request $request){
        $userDetails = Auth::user();
        $title = ['title'=>'Inspection Software'];
        return view('inspectionSoftware',compact('title','userDetails'));
    }

    public function happyCustomers(Request $request){
        $userDetails = Auth::user();
        $title = ['title'=>'Happy Customers'];
        return view('happyCustomers',compact('title','userDetails'));
    }

    public function mobileApp(Request $request){
        $userDetails = Auth::user();
        $title = ['title'=>'Mobile App'];
        return view('mobileApp',compact('title','userDetails'));
    }

    public function sampleReports(Request $request){
        $userDetails = Auth::user();
        $title = ['title'=>'Sample Reports'];
        return view('sampleReports',compact('title','userDetails'));
    }

    public function whyUs(Request $request){
        $userDetails = Auth::user();
        $title = ['title'=>'Why Easy 2 Inspect'];
        return view('whyUs',compact('title','userDetails'));
    }












}
