<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
class Admin extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'contact',
        'gender',
        'facebook',
        'instagram',
        'twitter',
        'profiles',
        'bio',
        'status',
    ];
    
 public function books(){
   return $this->hasMany(Books::class,'id','created_by');
}

}
