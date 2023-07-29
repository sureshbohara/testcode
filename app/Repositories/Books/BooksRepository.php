<?php
namespace App\Repositories\Books;
use App\Models\Books;
use Illuminate\Support\Facades\DB;
use Auth;
class BooksRepository implements BooksInterface
{
    
    public function getAll(){
     return Books::orderByDesc('id')->paginate(8);
    }
    
     public function create(array $data){
        return Books::create($data);
    }

    public function update(int $id, array $data){
        return Books::where('id', $id)->update($data);
    }

    public function delete(int $id){
        return Books::destroy($id);
    }

    public function find(int $id){
      return Books::findOrFail($id);
    }


   
}
