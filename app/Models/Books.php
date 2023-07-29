<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Books; 
use App\Models\BooksAuthors; 
class Books extends Model
{
    use HasFactory;

     protected $fillable = [
        'category_id',
        'name',
        'slug',
        'tags',
        'image',
        'type',
        'stock',
        'short_details',
        'long_details',
        'status',
        'view_count',
        'meta_title',
        'meta_description',
        'created_by',
        'updated_by',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category(){
     return $this->belongsTo(Category::class);
    }


   public function admin(){
     return $this->belongsTo(Admin::class,'created_by','id');
    }


    public function authors(){
        return $this->belongsToMany(Author::class, 'books_authors', 'book_id', 'author_id');
    }
}
