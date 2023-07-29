<?php
namespace App\Repositories\Admin;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Auth;
class AdminRepository implements AdminInterface
{


    public function getAll(){
      $loggedInUserId = Auth::guard('admin')->id();
     return Admin::where('id', '!=', $loggedInUserId)->orderBy('id', 'desc')->get();
    }
    


}
