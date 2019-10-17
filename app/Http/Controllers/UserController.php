<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Contact;
use App\Report;
use App\Asset;
use App\Notifications\UserVerifyEmailApp;
use PDF;

class UserController extends Controller
{
    public function userLogin(Request $request){
        $userDetails = Auth::user();
        if(!is_null($userDetails)){
            return redirect('dashboard');
        }

        $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
        $userdata = array(
          'email' => $request->input('email') ,
          'password' => $request->input('password')
        );
        if (Auth::attempt($userdata)){
            $userDetails = Auth::user();
            if($userDetails->user_type!='user'){
                Auth::logout();
                return  redirect('login')->with('error',"The password entered is incorrect, please enter the correct password.");
            }
            elseif($userDetails->status == '2'){
                Auth::logout();
                return redirect('login')->with('error',"Your account is blocked. Please contact to support.");
            }
        }
        else{
            return redirect('login')->with('error',"Please enter valid credentials.");
        }

        User::where('id',$userDetails->id)->update([
                        'last_login_time'=> $userDetails->login_time,
                        'login_time'=>date('Y-m-d H:i:s'),
                    ]);

        return redirect('dashboard');
    }

    public function dashboard(Request $request){
        $title = ['title'=>'Dashboard'];
        $userDetails = Auth::user();
        return view('user.userDashboard',compact('userDetails','title'));
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('login');
    }

    public function updateUserProfile(Request $request){
        $title = ['title'=>'Update Profile'];
        $userDetails = Auth::User();
        if(!empty($request->all())){

            if($userDetails->email == $request->input('email')){
                $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required',
                ]);
            }
            else{
                $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|unique:users',
                ]);
            }


            $update = User::where('id',$userDetails['id'])->update([
                        'first_name'=>$request->input('first_name'),
                        'last_name'=>$request->input('last_name'),
                        'email'=>$request->input('email'),
                    ]);

            if($update==1){
                return redirect('updateUserProfile')->with('success','Profile Updated Successfully.');
            }
            else{
                return redirect('updateUserProfile')->with('error','Something went wrong.');
            }
        }
        return view('user.updateUserProfile',compact('userDetails','title'));
    }

    public function updateUserPassword(Request $request){
        $title = ['title'=>'Update Password'];
        $userDetails = Auth::User();
        if(!empty($request->all())){
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required',
            ]);

            if (!Hash::check($request->input('old_password'), $userDetails->password)) {
                return redirect('updateUserPassword')->with('error','Enter old password correctly.');
            }


            $update = User::where('id',$userDetails['id'])->update([
                        'password'=>Hash::make($request->input('password')),
                    ]);

            if($update==1){
                return redirect('updateUserPassword')->with('success','Profile Password Updated Successfully.');
            }
            else{
                return redirect('updateUserPassword')->with('error','Something went wrong.');
            }
        }
        return view('user.updateUserPassword',compact('userDetails','title'));
    }

    public function verifyEmail(Request $request, $id){
    $user = User::where('api_token',$id)->first();
        if(is_null($user)){
          return redirect('login')->with('error','Token mismatched.');
        }
        User::where('id',$user->id)->update(['email_verified_at'=>date('Y-m-d H:i:s')]);
        return redirect('login')->with('success','Account Validated Thank You.');
    }



    public function resendVerificationEmail(Request $request){
        $user = Auth::user();
        $user->notify(new UserVerifyEmailApp($user));
        return redirect('email/verify')->with('success','Password resent link sent successfully.');
    }

    // public function reports(Request $request){
    //     $title = ['title'=>'Reports'];
    //     $userDetails = Auth::user();
    //     $reports = Report::orderBy('id','DESC')->get();
    //     return view('user.reports',compact('userDetails','title','reports'));
    // }

    // public function addReport(Request $request){
    //     $title = ['title'=>'Add Report'];
    //     $userDetails = Auth::user();
    //     if(!empty($request->all())){
    //         $data = $request->all();
    //         $pdf = PDF::loadView('user.pdf', compact('data'));
    //         if(!is_dir('uploads/pdf')) {
    //             mkdir('uploads/pdf');
    //         }
    //         $pdf->save('uploads/pdf/'.$userDetails->id.'_'.time().'_.pdf');
    //         // return $pdf->download(time().'_'.$userDetails->id.'.pdf');
    //     }
    //     return view('user.addReport',compact('userDetails','title'));
    // }

    // public function asset(Request $request){
    //     $title = ['title'=>'Assets'];
    //     $userDetails = Auth::user();
    //     $assets = Asset::where('user_id',$userDetails->id)->orderBy('id','DESC')->get();
    //     return view('user.assets',compact('userDetails','title','assets'));

    // }

    // public function addAsset(Request $request){

    // }
}
