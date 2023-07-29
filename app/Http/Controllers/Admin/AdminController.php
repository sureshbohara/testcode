<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Repositories\Admin\AdminInterface;
use App\Http\Requests\AdminRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Intervention\Image\Facades\Image;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    
    private $adminRepository;
    public function __construct(AdminInterface $adminRepository){
     $this->adminRepository = $adminRepository;
      
    }


   public function dashboard(){
    return view('backend.dashboard');
  }



   // account login
     public function adminLogin(Request $request){
      if ($request->isMethod('post')) {
        $data = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:30',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Valid Email is required',
            'password.required' => 'Password is required',
        ]);

        $userStatus = Admin::where('email', $data['email'])->first();
        if ($userStatus === null) {
            $message = 'Email not found';
            return response()->json(['status' => 404, 'msg' => $message]);
        } elseif ($userStatus->status == 0) {
            $message = 'Your account is not active';
            return response()->json(['status' => 403, 'msg' => $message]);
        } else {
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                // Remember me admin email and password cookie
                if (isset($data['remember']) && !empty($data['remember'])) {
                    setcookie('email', $data['email'], time() + 3600);
                    setcookie('password', $data['password'], time() + 3600);
                } else {
                    setcookie('email', '');
                    setcookie('password', '');
                }
                $message = 'User login successfully!';
                return response()->json(['status' => 200, 'msg' => $message]);
            } else {
                $message = 'Your Email or Password is incorrect!';
                return response()->json(['status' => 401, 'msg' => $message]);
            }
        }
    }
    
    return view('backend.login');
}




  // account logout
    public function adminLogout(Request $request){
      $request->session()->flush();
      Auth::logout();
     $request->session()->flash('toastr_message', 'Logged Out successfully');
     return redirect()->route('admin.login');
    }
    // account delete
    public function accountDelete(Request $request){
      $user = Admin::where('id', Auth::guard('admin')->user()->id)->first();
      $user->delete();
      $request->session()->flash('toastr_message', 'Your account has been deleted');
      return redirect()->route('admin.login');
    }


    // admin profiles update
     public function updateAdminDetails(Request $request){
      if ($request->isMethod('post')) {
        $data = $request->all();
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:10',
            'profiles' => 'nullable',
            'bio' => 'nullable',
            'gender' => 'nullable',
        ];
        $messages = [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'address.required' => 'The address field is required.',
            'contact.required' => 'The mobile number field is required.',
            'contact.max' => 'The mobile number field may not be greater than :max characters.',
        ];
        $validatedData = $request->validate($rules, $messages);
        $user = Admin::where('id', Auth::guard('admin')->user()->id)->first();
        $user->name = $data['name'];
        $user->address = $data['address'];
        $user->contact = $data['contact'];
        $user->gender = $data['gender'];
        $user->facebook = $data['facebook'];
        $user->instagram = $data['instagram'];
        $user->twitter = $data['twitter'];
        $user->bio = $data['bio'];

        if ($request->hasFile('profiles')) {
        $file = $request->file('profiles');
        $user->profiles = ImageHelper::handleUpdatedUploadedImage($file, 'images', $user->toArray(), 'images/', 'profiles');
        }

        $user->save();
        $message = "Profile updated successfully!";
        return response()->json(['msg' => $message],200);
      }
    $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
    return view('backend.users.update_profiles', compact('adminDetails'));
}

// admin password change
  public function updatePassword(Request $request){
       if($request->isMethod('post')){
        $data = $request->all();
         $rules =  [
         'current_password' => 'required',
         'new_password' => 'required|min:6|confirmed',
         ];
         $customMessage = [
              'current_password.required' => 'The current password field is required.',
              'new_password.required' => 'The new password field is required.',
              'new_password.min' => 'The new password must be at least 6 characters.',
              'new_password.confirmed' => 'The new password confirmation does not match.',
           ];

         $this->validate($request, $rules, $customMessage);
         $user = Admin::where('id', Auth::guard('admin')->user()->id)->first();
         if(Hash::check($data['current_password'], $user->password)) {
         $user->password = Hash::make($data['new_password']);
         $user->save();
         $message = "Password changed successfully!!";
         return response()->json(['msg'=>$message]);
         }else{
          return response()->json(['msg'=>['current_password'=>['Current password is incorrect.']]], 422);
         }
       }

        return view('backend.users.update_password');
    }




   // admin profiles
    public function adminProfile(){
     $adminProfile = Admin::where('email',Auth::guard('admin')->user()->email)->first();
    return view('backend.users.admin_profile',compact('adminProfile'));   
   }

}
