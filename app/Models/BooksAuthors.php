<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooksAuthors extends Model
{
    use HasFactory;
    protected $table = 'books_authors';
    public function author(){
        return$this->belongsTo(Authors::class,'author_id');
    }

    public function books(){
      return$this->belongsTo(Books::class,'book_id');
    }
}
