<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Term;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\OauthClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Notifications\UserVerifyEmailApp;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Inspection;
use App\Privacy;
use DB;


class AuthController extends Controller{

  use SendsPasswordResetEmails;

  protected $oauthClientKeys;
  
  public function __construct(Request $request){
    
    $this->oauthClientKeys = OauthClient::orderBy('id','DESC')->first();

  }
  
  public function register(Request $request){
    $validator = Validator::make($request->all(), [
                  'email'=>'required|unique:users',
                  'first_name'=>'required',       
                  'last_name'=>'required',       
                  'phone_number'=>'required',       
                  'password'=>'required',
                  'device_type'=>'required',
                  'device_info'=>'required',
                  'device_token'=>'required',
                ],
                ['email.unique'=>'Email Address already registered please sign in using credentials or click forgot password to reset.']

              );

    if ($validator->fails()) { 
        $errors = array();
        foreach ($validator->messages()->all() as $message){ 
          array_push($errors,$message);
        }   
        return response([
            'success' => false,
            'errors' => $errors
          ], 200)->header('Content-Type', 'application/json'); 
    }
      
    $user = User::create([
            'name' => strtolower($request->first_name.' '.$request->last_name),
            'first_name' => strtolower($request->first_name),
            'last_name' => strtolower($request->last_name),
            'phone_number' => strtolower($request->phone_number),
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'user_type' => 'user',
            'login_time' => date('Y-m-d H:i:s'),
            'api_token' => Str::random(60),
            'device_type'=>$request->device_type,
            'device_info'=>$request->device_info,
            'device_token'=>$request->device_token,
    ]);
    $user->notify(new UserVerifyEmailApp($user));

    $http = new Client;

    $response = $http->post(url('oauth/token'), [
        'form_params' => [ 
            'grant_type' => 'password',
            'client_id' => $this->oauthClientKeys->id,
            'client_secret' => $this->oauthClientKeys->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '*',
        ],

    ]);
    return response ([
      'success'=> true,
      'message'=>'Account Created, Please click on link in email to validate your registration.',        
      'user_data'=>$user,
      'data'=>json_decode(( string ) $response->getBody(),true )],200)->header('Content-Type', 'application/json');
  }

  public function login(Request $request){
    $validator = Validator::make($request->all(), [
                  'email'=>'required',
                  'password'=>'required',
                ]);

    if ($validator->fails()) {
        $errors = array();
        foreach ($validator->messages()->all() as $message){
          array_push($errors,$message);
        }   
        return response([
            'success' => false,
            'errors' => $errors
          ], 200)->header('Content-Type', 'application/json');
    }

    $user = User::where('email',$request->email)->first();

    /*check user existance*/
    if(empty($user)){
      return response([
        'success' => false,
        'errors' => ['There is no account with this '.$request->email.' registered with us.'],
      ], 200)->header('Content-Type', 'application/json');
    }

    /*check user password*/
    if (!Hash::check($request->password, $user->password)) {
      return response([
        'success' => false,
        'errors' => ['The password entered is incorrect, please enter the correct password.'],
      ], 200)->header('Content-Type', 'application/json');
    }

    /*check user existance*/
   /*  if(is_null($user->email_verified_at)){
      return response([
        'success' => false,
        'errors' => ['Please verify your email before accessing to the app features.'],
      ], 200)->header('Content-Type', 'application/json');
    } */

    User::where('id',$user->id)->update([
      'last_login_time'=> $user->login_time,
      'login_time'=>date('Y-m-d H:i:s'),
    ]);

    $http = new Client;

    $response = $http->post(url('oauth/token'), [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => $this->oauthClientKeys->id,
            'client_secret' => $this->oauthClientKeys->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '*',
        ],
    ]);

    $user['profile_picture'] = empty($user->profile_picture)?'':url($user->profile_picture);
    return response ([
      'success'=>true,
      'message'=>'Login successfully.',
      'user_data'=>$user,
      'data'=>json_decode(( string ) $response->getBody(),true )],200)->header('Content-Type', 'application/json');
  }

  public function getUserProfile(Request $request){
    $userDetails = Auth::user();
    $userDetails['profile_picture'] = empty($userDetails->profile_picture)?'':url($userDetails->profile_picture);
    return response([
            'status'=>true, 
            'message'=>'Login successfully.',
            'user_data'=>$userDetails
          ], 200)->header('Content-Type', 'application/json');
  }
  
  public function getTerms(Request $request){
    $terms = Term::first();
    return response([
            'status'=>true,
            'message'=>'Terms are found.',
            'data'=>$terms
          ], 200)->header('Content-Type', 'application/json');
  }
  
  public function refreshToken(Request $request){
    
    $validator = Validator::make($request->all(), [
                    'refresh_token'=>'required',
                  ]);

      if ($validator->fails()) {
          $errors = array();
          foreach ($validator->messages()->all() as $message){
            array_push($errors,$message);
          }   
          return response([
              'success' => false,
              'errors' => $errors
            ], 200)->header('Content-Type', 'application/json');
      }


    
    
    $http = new Client;

    $response = $http->post(url('oauth/token'), [
      'form_params' => [
        'grant_type' => 'refresh_token',
        'refresh_token' => $request->refresh_token,
        'client_id' => $this->oauthClientKeys->id,
        'client_secret' => $this->oauthClientKeys->secret,
        'scope' => '*',
      ],
    ]);

    return response ([
      'success'=>true,
      'message'=>'Refresh token generated successfully.',
      'data'=>json_decode(( string ) $response->getBody(),true )],200)->header('Content-Type', 'application/json');
  }

  public function resendVerificationEmail(Request $request){
    $validator = Validator::make($request->all(), [
                    'user_id'=>'required',
                  ]);

    if ($validator->fails()) {
        $errors = array();
        foreach ($validator->messages()->all() as $message){
          array_push($errors,$message);
        }   
        return response([
            'success' => false,
            'errors' => $errors
          ], 200)->header('Content-Type', 'application/json');
    }

    $user = User::where('id',$request->user_id)->first();
    
    if(is_null($user)){
      return response([
        'success' => false,
        'errors' => ['No user found with this user id'],
      ], 200)->header('Content-Type', 'application/json');
    }

    $user->notify(new UserVerifyEmailApp($user));
    
    return response([
        'success' => true,
        'message' => 'Verification email sent successfully.',
      ], 200)->header('Content-Type', 'application/json');
    
  }

  public function changePassword(Request $request){
    $userDetails = Auth::User();
    $validator = Validator::make($request->all(), [   
                'old_password'=>'required',
                'password'=>'required',
              ]);

    if ($validator->fails()) {
        $errors = array();
        foreach ($validator->messages()->all() as $message){
          array_push($errors,$message);
        }   
        return response([
          'success' => false,
          'errors' => $errors
        ], 200)->header('Content-Type', 'application/json'); 
    }

    if(is_null($userDetails)){
      return response([
        'success' => false,
        'errors' => ['No user found.'],
      ], 200)->header('Content-Type', 'application/json');
    }

    if (!Hash::check($request->old_password, $userDetails->password)) {
      return response([
        'success' => false,
        'errors' => ['Please enter old password correctly.'],
      ], 200)->header('Content-Type', 'application/json');
    }

    $updatePassword = User::where('id',$userDetails->id)->update([
      'password'=>Hash::make($request->password)
    ]);

    if($updatePassword=='1'){
      return response([
        'success' => true,
        'message' => 'Password has been updated successfully.',
      ], 200)->header('Content-Type', 'application/json');
    }
    else{
      return response([
        'success' => false,
        'errors' => ['Something went wrong.'],
      ], 200)->header('Content-Type', 'application/json');
    }

  }

  public function logout(Request $request){
    if (Auth::check()) {
       Auth::user()->AauthAcessToken()->delete();
        return response([
          'success' => true,
          'errors' => ['Logout successfully.'],
        ], 200)->header('Content-Type', 'application/json');
    }
    else{
        return response([
          'success' => false,
          'errors' => ['No login session found.'],
        ], 200)->header('Content-Type', 'application/json');
    }
  }

  public function updateProfile(Request $request){
    $userDetails = Auth::User();
    $validator = Validator::make($request->all(), [   
                // 'first_name'=>'',
                // 'last_name'=>'',
                // 'phone_number'=>'',
                'profile_picture'     =>  'image|mimes:jpeg,png,jpg,gif|max:5120'
              ]);

    if ($validator->fails()) {
        $errors = array();
        foreach ($validator->messages()->all() as $message){
          array_push($errors,$message);
        }   
        return response([
          'success' => false,
          'errors' => $errors
        ], 200)->header('Content-Type', 'application/json'); 
    }

    if(is_null($userDetails)){
      return response([
        'success' => false,
        'errors' => ['No user found.'],
      ], 200)->header('Content-Type', 'application/json');
    }
    $filePath = $userDetails->profile_picture;
    if($request->hasFile('profile_picture')){
      $file = $request->file('profile_picture');
      $fileName = time().'_'.$file->getClientOriginalName();
      $file->move('uploads',$fileName);
      $filePath = 'uploads/'.$fileName;
    }

    if(empty($request->first_name) && empty($request->last_name)){
      $name = $userDetails->name;
    }
    elseif(!empty($request->first_name) && !empty($request->last_name)){
      $name = $request->first_name.' '.$request->last_name;
    }
    elseif(empty($request->first_name) && !empty($request->last_name)){
      $name = $userDetails->first_name.' '.$request->last_name;
    }
    else{
      $name = $request->first_name.' '.$userDetails->last_name;
    }

    $updateProfile = User::where('id',$userDetails->id)->update([
      'first_name'=>empty($request->first_name)?$userDetails->first_name:$request->first_name,
      'last_name'=>empty($request->last_name)?$userDetails->last_name:$request->last_name,
      'name'=>$name,
      'phone_number'=>empty($request->phone_number)?$userDetails->phone_number:$request->phone_number,
      'profile_picture'=>is_null($filePath)?'': $filePath,
    ]);


    if($updateProfile=='1'){
      $updateUserProfile = User::where('id',$userDetails->id)->first();
      $updateUserProfile['profile_picture'] = empty($filePath)?url($updateUserProfile->profile_picture):url($filePath);
      return response([
        'success' => true,
        'message' => 'Profile updated successfully.',
        'user_data'=>$updateUserProfile,
      ], 200)->header('Content-Type', 'application/json');
    }
    else{
      return response([
        'success' => false,
        'errors' => ['Something went wrong.'],
      ], 200)->header('Content-Type', 'application/json');
    }
  }
  
  public function forgotPassword(Request $request){
    $validator = Validator::make($request->all(), [  
                'email'     =>  'required'
              ]);

    if ($validator->fails()) {
        $errors = array();
        foreach ($validator->messages()->all() as $message){
          array_push($errors,$message);
        }   
        return response([
          'success' => false,
          'errors' => $errors
        ], 200)->header('Content-Type', 'application/json'); 
    }

    $userDetails = User::where('email',$request->email)->first();

    if(is_null($userDetails)){
      return response([
        'success' => false,
        'errors' => ['There is no account associated with this '.$request->email.' email address.'],
      ], 200)->header('Content-Type', 'application/json');
    }

    $this->sendResetLinkEmail($request);
    return response([
      'success' => true,
      'message' => 'A password link sent to your email.',
    ], 200)->header('Content-Type', 'application/json');
     
  }

  public function addInspection(Request $request){
    $userDetails = Auth::User();
    $validator = Validator::make($request->all(), [   
                'property_name'=>'required|max:80',
                'property_address'=>'required',
                'property_type'=>'required|max:80',
                'tenant_name'=>'required|max:80',
                'tenant_email'=>'required|max:80',
                'tenant_type'=>'required|max:80',
                'inspection_dateTime'=>'required',
              ]);

    if ($validator->fails()) {
        $errors = array();
        foreach ($validator->messages()->all() as $message){
          array_push($errors,$message);
        }   
        return response([
          'success' => false,
          'errors' => $errors
        ], 200)->header('Content-Type', 'application/json'); 
    }

    if(is_null($userDetails)){
      return response([
        'success' => false,
        'errors' => ['No user found.'],
      ], 200)->header('Content-Type', 'application/json');
    }

    $inspetion = Inspection::create([
        'user_id'=>$userDetails->id,
        'property_name'=>$request->property_name,
        'property_address'=>$request->property_address,
        'property_type'=>$request->property_type,
        'tenant_name'=>$request->tenant_name,
        'tenant_email'=>$request->tenant_email,
        'tenant_type'=>$request->tenant_type,
        'inspection_dateTime'=>date('Y-m-d H:i:s',strtotime($request->inspection_dateTime)),
    ]);


    if(!is_null($inspetion)){
      return response([
        'success' => true,
        'message' => 'Inspection added successfully.',
        'inspection_data'=>$inspetion
      ], 200)->header('Content-Type', 'application/json');
    }
    else{
      return response([
        'success' => false,
        'errors' => ['Something went wrong.'],
      ], 200)->header('Content-Type', 'application/json');
    }
  
  }

  public function getAllUserInspection(Request $request){
    $userDetails = Auth::User();
    if(is_null($userDetails)){
      return response([
        'success' => false,
        'errors' => ['No user found.'],
      ], 200)->header('Content-Type', 'application/json');
    }

    $inspetion = $userDetails->getUserInspection; 
    return response([
      'success' => true,
      'message' => 'Inspection added successfully.',
      'inspection_data'=>$inspetion,
    ], 200)->header('Content-Type', 'application/json');

  }

  public function editInspection(Request $request){
    $userDetails = Auth::User();
    $validator = Validator::make($request->all(), [   
                'inspection_id'=>'required',
                'property_name'=>'max:80',
                // 'property_address'=>'',
                'property_type'=>'max:80',
                'tenant_name'=>'max:80',
                'tenant_email'=>'max:80',
                'tenant_type'=>'max:80',
              ]);

    if ($validator->fails()) {
        $errors = array();
        foreach ($validator->messages()->all() as $message){
          array_push($errors,$message);
        }   
        return response([
          'success' => false,
          'errors' => $errors
        ], 200)->header('Content-Type', 'application/json'); 
    }

    if(is_null($userDetails)){
      return response([
        'success' => false,
        'errors' => ['No user found.'],
      ], 200)->header('Content-Type', 'application/json');
    }

    $inspectionDetail = Inspection::where('id',$request->inspection_id)->first();

    if(is_null($inspectionDetail)){
      return response([
        'success' => false,
        'errors' => ['No inspetion found.'],
      ], 200)->header('Content-Type', 'application/json');
    }


    $update = Inspection::where('id',$request->inspection_id)->update([
        'user_id'=>$userDetails->id,
        'property_name'=>empty($request->property_name)?$inspectionDetail->property_name:$request->property_name,
        'property_address'=>empty($request->property_address)?$inspectionDetail->property_address:$request->property_address,
        'property_type'=>empty($request->property_type)?$inspectionDetail->property_type:$request->property_type,
        'tenant_name'=>empty($request->tenant_name)?$inspectionDetail->tenant_name:$request->tenant_name,
        'tenant_email'=>empty($request->tenant_email)?$inspectionDetail->tenant_email:$request->tenant_email,
        'tenant_type'=>empty($request->tenant_type)?$inspectionDetail->tenant_type:$request->tenant_type,
        'inspection_dateTime'=>empty($request->inspection_dateTime)?$inspectionDetail->inspection_dateTime:date('Y-m-d H:i:s',strtotime($request->inspection_dateTime)),
    ]);

    if($update=='1'){
      $updatedInspectionDetail = Inspection::where('id',$request->inspection_id)->first();
      return response([
        'success' => true,
        'message' => 'Inspection updated successfully.',
        'inspection_data'=>$updatedInspectionDetail
      ], 200)->header('Content-Type', 'application/json');
    }
    else{
      return response([
        'success' => false,
        'errors' => ['Something went wrong.'],
      ], 200)->header('Content-Type', 'application/json');
    }

  }

  public function privacyPolicy(Request $request){
    $privacyPolicy = Privacy::first();
    return response([
      'status'=>true,
      'message'=>'Privacy Policy are found.',
      'data'=>$privacyPolicy
    ], 200)->header('Content-Type', 'application/json');
  }



}
