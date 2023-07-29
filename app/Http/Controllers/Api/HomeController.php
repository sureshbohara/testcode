<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BooksResource;
use App\Models\Category;
use App\Models\Books;
use App\Http\Requests\BooksRequest;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Log;
use App\Models\BooksAuthors;
use Illuminate\Http\Response;
class HomeController extends Controller
{
    
     public function index(){
        $books = Books::orderByDesc('id')->get();
        return response()->json(['booksData' => BooksResource::collection($books)]);
    }


     public function store(BooksRequest $request){
      try {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::handleUploadedImage($request->file('image'), 'images');
        }
        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['name'];
        }
        $data['created_by'] = auth()->guard('admin')->user()->id;
        $book = Books::create($data);
        $book->authors()->sync($request->input('author_id'));
        return new BooksResource($book);
    } catch (\Exception $exception) {
        Log::error('Failed to create books: ' . $exception->getMessage());
        return response()->json(['error' => 'Failed to create books.'], 500);
    }

}


   public function show($id) {
    try {
        $book = Books::findOrFail($id);
        return new BooksResource($book);
    } catch (ModelNotFoundException $exception) {
        return response()->json(['error' => 'Book not found.'], Response::HTTP_NOT_FOUND);
    } catch (\Exception $exception) {
        Log::error('An error occurred while fetching the data: ' . $exception->getMessage());
        return response()->json(['error' => 'An error occurred while fetching the data.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
 }



public function update(BooksRequest $request, $id){
    try {
        $book = Books::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::handleUploadedImage($request->file('image'), 'images');
        }
        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['name'];
        }
        $book->update($data);
        if($request->has('author_id')) {
           $book->authors()->sync($request->input('author_id'));
           } else {
          $book->authors()->detach();
        }
        return new BooksResource($book);
    } catch (ModelNotFoundException $exception) {
        return response()->json(['error' => 'Book not found.'], Response::HTTP_NOT_FOUND);
    } catch (\Exception $exception) {
        Log::error('Failed to update book: ' . $exception->getMessage());
        return response()->json(['error' => 'Failed to update book.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}



public function destroy($id){
    try {
        $book = Books::findOrFail($id);
        BooksAuthors::where('book_id', $book['id'])->delete();
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully.']);
    } catch (ModelNotFoundException $exception) {
        return response()->json(['error' => 'Book not found.'], Response::HTTP_NOT_FOUND);
    } catch (\Throwable $exception) {
        Log::error('Failed to delete book: ' . $exception->getMessage());
        return response()->json(['error' => 'Failed to delete book.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}


// category by books
public function categoryBooks($id){
    try {
        $category = Category::findOrFail($id);
        $books = $category->books; 
        return response()->json([
            'category_name' => $category->name,
            'booksData' => BooksResource::collection($books),
        ]);
    } catch (ModelNotFoundException $exception) {
        return response()->json(['error' => 'Category not found.'], Response::HTTP_NOT_FOUND);
    } catch (\Exception $exception) {
        Log::error('An error occurred while fetching the data: ' . $exception->getMessage());
        return response()->json(['error' => 'An error occurred while fetching the data.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}


//books details
public function detailsBooks($id){
    try {
      $book = Books::findOrFail($id);
      return new BooksResource($book);
    } catch (ModelNotFoundException $exception) {
        return response()->json(['error' => 'Book not found.'], Response::HTTP_NOT_FOUND);
    } catch (\Exception $exception) {
        Log::error('An error occurred while fetching the data: ' . $exception->getMessage());
        return response()->json(['error' => 'An error occurred while fetching the data.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}


}