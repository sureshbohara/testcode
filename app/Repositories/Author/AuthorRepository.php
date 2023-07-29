<?php
namespace App\Repositories\Author;
use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Auth;
class AuthorRepository implements AuthorInterface
{
    
    public function getAll(){
     return Author::orderByDesc('id')->paginate(8);
    }
    
     public function create(array $data){
        return Author::create($data);
    }

    public function update(int $id, array $data){
        return Author::where('id', $id)->update($data);
    }

    public function delete(int $id){
        return Author::destroy($id);
    }

    public function find(int $id){
      return Author::findOrFail($id);
    }


   
}
