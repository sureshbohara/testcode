<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Books;
use App\Helpers\CategoryHelper;
class HomeController extends Controller
{
   
    public function index(){
       $data['getCategories'] = Category::getCategories();
       $data['books'] = Books::where('status',1)->orderByDesc('id')->get();
      return view('welcome',$data);
    } 



   public function searchItem(Request $request) {
    $data['books'] = Books::join('categories', 'books.category_id', '=', 'categories.id')
                    ->where(function ($query) use ($request) {
                        $query->where('categories.name', 'LIKE', "%{$request->search}%")
                            ->orWhere('books.name', 'LIKE', "%{$request->search}%");
                    })
                  ->get();
    return view('books', $data);
}




 public function category(Request $request, $category_id = null){
    $query = $request->has('search') ? (!empty($request->search) ? $request->search : null) : null;
    $conditions = ['status' => 1];
    $books = Books::where($conditions);
    if ($category_id != null) {
        $category_ids = CategoryHelper::getCategoryIds($category_id);
        $books->whereIn('category_id', $category_ids);
    }
    $books = $books->with('category')
        ->orderByDesc('id')->paginate(12)->appends(request()->query());
         // header category
    $getCategories = Category::getCategories();
    return view('category_books', compact('books', 'category_id', 'query', 'getCategories'));
   }


     public function listing(Request $request){
       return $this->category($request);
     }


     public function categoryBooks(Request $request, $slug){
          $category = Category::where('slug', $slug)->first();
           if($category != null) {
             return $this->category($request, $category->id);
          }
          abort(404);
    }



public function authorByBooks(Request $request, $name){
    $books = Books::whereHas('authors', function ($query) use ($name) {
        $query->where('name', $name);
    })->with('authors')->paginate(12)->appends(request()->query());
    // header category
    $getCategories = Category::getCategories();
    return view('category_books', compact('books', 'name','getCategories'));
}


// books details
public function booksDetails(Request $request,$slug){
    $booksDetails = Books::where('slug', $slug)->firstOrFail();
  return view('books_details',compact('booksDetails'));
}

}
