<?php

namespace App\Http\Controllers;
use App\User;
use App\Contact;
use App\Term;
use App\Privacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{
    public function admin(Request $request){
        $adminDetails = Auth::user();
        if(!is_null($adminDetails) && $adminDetails->user_type=="admin" ){
            return redirect('adminDashboard');
        }
        return view('admin.login');
    }

    public function adminLogin(Request $request){
        $adminDetails = Auth::user();
        if(!is_null($adminDetails)){
            return redirect('adminDashboard');
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
            $adminDetails = Auth::user();
            if($adminDetails->user_type!='admin'){
                Auth::logout();
                return  redirect('admin')->with('error',"Please enter valid credentials.");
            }
        }
        else{
            return redirect('admin')->with('error',"Please enter valid credentials.");
        }
        User::where('id',$adminDetails->id)->update([
                        'login_time'=>date('Y-m-d H:i:s'),
                    ]);

        return redirect('userList');
    }


    public function dashboard(Request $request){
        $title = ['title'=>'Dashboard'];
        $adminDetails = Auth::user();
        return view('admin.dashboard',compact('adminDetails','title'));
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('admin');
    }

    public function updateAdminProfile(Request $request){
        $title = ['title'=>'Update Profile'];
        $adminDetails = Auth::User();
        if(!empty($request->all())){
            $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);

            $update = User::where('id',$adminDetails['id'])->update([
                        'name'=>$request->input('name'),
                        'email'=>$request->input('email'),
                    ]);

            if($update==1){
                return redirect('updateAdminProfile')->with('success','Profile Updated Successfully.');
            }
            else{
                return redirect('updateAdminProfile')->with('error','Something went wrong.');
            }
        }
        return view('admin.updateProfile',compact('adminDetails','title'));
    }

    public function updateAdminPassword(Request $request){
        $title = ['title'=>'Update Password'];
        $adminDetails = Auth::User();
        if(!empty($request->all())){
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]);

            if (!Hash::check($request->input('old_password'), $adminDetails->password)) {
                return redirect('updateAdminPassword')->with('error','Enter old password correctly.');
            }


            $update = User::where('id',$adminDetails['id'])->update([
                        'password'=>Hash::make($request->input('password')),
                    ]);

            if($update==1){
                return redirect('updateAdminPassword')->with('success','Profile Password Updated Successfully.');
            }
            else{
                return redirect('updateAdminPassword')->with('error','Something went wrong.');
            }
        }
        return view('admin.updateAdminPassword',compact('adminDetails','title'));
    }
    
    public function userList(Request $request){
        $title = ['title'=>'Users'];
        $adminDetails = Auth::User();
        $users = User::where('user_type','<>','admin')->orderBy('id','DESC')->get();
        return view('admin.userList',compact('adminDetails','users','title'));
    }

    public function editUser(Request $request,$id){
        $title = ['title'=>'Edit User'];
        $adminDetails = Auth::User();
        $user = User::where('id',base64_decode($id))->first();
        if(!empty($request->all())){
            if($user->email!=$request->input('email')){
                $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|unique:users',
                ]);
            }
            else{
                $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required',
                ]);
            }
            $update  = User::where('id',base64_decode($id))->update([
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'name'=>$request->input('first_name').' '.$request->input('first_name'),
                'email'=>$request->input('email'),
                'phone_number'=>$request->input('phone_number'),
            ]);
            
            if($update==1){
                return redirect('userList')->with('success','User edited successfully.');
            }
            else{
                return redirect('userList')->with('error','Something went wrong.');
            }

        }
        else{
            return view('admin.editUser',compact('adminDetails','user','title'));
        }
    }

    public function blockUser(Request $request,$id){
        $user = User::where('id',base64_decode($id))->first();
        $update  = User::where('id',base64_decode($id))->update([
                'status'=>2,
            ]);
            
        if($update==1){
            return redirect('userList')->with('success','User blocked successfully.');
        }
        else{
            return redirect('userList')->with('error','Something went wrong.');
        }
    }

    public function unblockUser(Request $request,$id){
        $user = User::where('id',base64_decode($id))->first();
        $update  = User::where('id',base64_decode($id))->update([
                'status'=>1,
            ]);
            
        if($update==1){
            return redirect('userList')->with('success','User unblocked successfully.');
        }
        else{
            return redirect('userList')->with('error','Something went wrong.');
        }
    }

    public function deleteUser(Request $request,$id){
        $user = User::where('id',base64_decode($id))->first();
        $update  = User::where('id',base64_decode($id))->delete();
            
        if($update==1){
            return redirect('userList')->with('success','User deleted successfully.');
        }
        else{
            return redirect('userList')->with('error','Something went wrong.');
        }
    }

    public function contactList(Request $request){
        $title = ['title'=>'Contacts'];
        $adminDetails = Auth::user();
        $contactLists = Contact::orderBy('id','DESC')->get();
        return view('admin.contactLists',compact('adminDetails','contactLists','title'));
    }


    public function term(Request $request){
        $title = ['title'=>'Terms'];
        $adminDetails = Auth::user();
        $terms = Term::orderBy('id','DESC')->get();
        return view('admin.terms',compact('adminDetails','terms','title'));
    }

    public function addTerms(Request $request){
        $terms = Term::orderBy('id','DESC')->get();
        if($terms->count()>=1){
            return redirect('term');
        }
        $title = ['title'=>'Add Terms'];
        $adminDetails = Auth::user();
        if(!empty($request->all())){
           $request->validate([
            'title'=>'required|max:30|min:5',
            'description'=>'required',
           ]);

            $term = Term::create([
                        'title'=>$request->input('title'),
                        'description'=>$request->input('description'),
                    ]);   

            if($term){
                return redirect('term')->with('success','Terms of service added successfully.');
            } 
            else{
                 return redirect('term')->with('error','Something went wrong.');
            }
        }
        return view('admin.addTerms',compact('adminDetails','title'));
    }


    public function editTerm(Request $request, $id){
        $title = ['title'=>'Edit Terms'];
        $adminDetails = Auth::user();
        $term = Term::where('id',base64_decode($id))->first();
        if(!empty($request->all())){
           $request->validate([
            'title'=>'required|max:30|min:5',
            'description'=>'required',
           ]);


            $update = Term::where('id',base64_decode($id))->update([
                        'title'=>$request->input('title'),
                        'description'=>$request->input('description'),
                    ]);   

            if($update){
                return redirect('term')->with('success','Terms of service updated successfully.');
            } 
            else{
                 return redirect('term')->with('success','Something went wrong.');
            }
        }
        return view('admin.editTerm',compact('adminDetails','title','term'));
    }

    public function deleteTerm(Request $request, $id){
        $delete = Term::where('id',base64_decode($id))->delete();   
        return redirect('term')->with('success','Terms of service deleted successfully.');
    }

    public function privacyPolicy(){
        $title = ['title'=>'Privacy Policy'];
        $adminDetails = Auth::user();
        $privacy = Privacy::orderBy('id','DESC')->get();
        return view('admin.privacyPolicy',compact('adminDetails','privacy','title'));
    }

    public function addPrivacyPolicy(Request $request){
        $privacyPolicy = Privacy::orderBy('id','DESC')->get();
        if($privacyPolicy->count()>=1){
            return redirect('privacyPolicy');
        }
        $title = ['title'=>'Add Privacy Policy'];
        $adminDetails = Auth::user();
        if(!empty($request->all())){
           $request->validate([
            'title'=>'required|max:30|min:5',
            'description'=>'required',
           ]);

            $privacy = Privacy::create([
                        'title'=>$request->input('title'),
                        'description'=>$request->input('description'),
                    ]);   

            if($privacy){
                return redirect('privacyPolicy')->with('success','Privacy Policy added successfully.');
            } 
            else{
                 return redirect('privacyPolicy')->with('success','Something went wrong.');
            }
        }
        return view('admin.addPrivacyPolicy',compact('adminDetails','title'));
    }

    public function editPrivacyPolicy(Request $request, $id){
        $title = ['title'=>'Edit Privacy Policy'];
        $adminDetails = Auth::user();
        $privacy = Privacy::where('id',base64_decode($id))->first();
        if(!empty($request->all())){
           $request->validate([
            'title'=>'required|max:30|min:5',
            'description'=>'required',
           ]);


            $update = Privacy::where('id',base64_decode($id))->update([
                        'title'=>$request->input('title'),
                        'description'=>$request->input('description'),
                    ]);   

            if($update==1){
                return redirect('privacyPolicy')->with('success','Privacy Policy updated successfully.');
            } 
            else{
                 return redirect('privacyPolicy')->with('error','Something went wrong.');
            }
        }
        return view('admin.editPrivacyPolicy',compact('adminDetails','title','privacy'));
    }

    public function deletePrivacyPolicy(Request $request, $id){
        $delete = Privacy::where('id',base64_decode($id))->delete();   
        return redirect('privacyPolicy')->with('success','Privacy Policy deleted successfully.');
    }


    

    

    
}
