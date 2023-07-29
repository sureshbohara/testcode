<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Category; 
use App\Models\Books; 
class Category extends Model
{
    use HasFactory;
    
      protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'image',
        'type',
        'description',
        'order_level',
        'status',
        'meta_title',
        'meta_description',
    ];


    public function books(){
        return $this->hasMany(Books::class);
    }
    
    protected static function boot(){
        parent::boot();
        static::deleting(function ($category) {
            $category->books()->delete();
        });
    }


     public function setNameAttribute($value){
     $this->attributes['name'] = $value;
     $this->attributes['slug'] = Str::slug($value);
    }

    public function parentcategory(){
      return $this->hasOne('App\Models\Category','id','parent_id')->select('id','name','slug')->where('status',1);
    }
    
    public function subCategories(){
     return $this->hasMany('App\Models\Category', 'parent_id', 'id')->where('status', 1);
   }

   

     public static function getCategories(){
      $getCategories = Category::with(['subCategories'=>function($query){
        $query->with('subCategories');}])
      ->where('parent_id',0)
      ->select('id','parent_id','name', 'slug', 'image')
      ->where('status',1)
      ->orderBy('order_level','asc')
      ->get();
      return $getCategories;
     }



     
}


