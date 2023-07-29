<?php
namespace App\Repositories\Category;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Auth;
class CategoryRepository implements CategoryInterface
{
    
    public function getAll(){
     return Category::with('parentcategory')->orderByDesc('id')->paginate(8);
    }
    
     public function create(array $data){
        return Category::create($data);
    }

    public function update(int $id, array $data){
        return Category::where('id', $id)->update($data);
    }

    public function delete(int $id){
        return Category::destroy($id);
    }

    public function find(int $id){
        return Category::findOrFail($id);
    }


   
}
