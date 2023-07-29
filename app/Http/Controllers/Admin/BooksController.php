<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Repositories\Books\BooksInterface;
use App\Http\Requests\BooksRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\BooksAuthors;
class BooksController extends Controller
{
    private $repository;
    public function __construct(BooksInterface $repository){
        $this->repository = $repository;
        $this->middleware('auth:admin');
    }

     public function index(){
        $data['books'] = $this->repository->getAll();
        return view('backend.books.index', $data);
    }

    public function create(){
        $getCategories = Category::getCategories();
        return view('backend.books.create',compact('getCategories'));
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

            $data['status'] = $request->input('button') === 'unpublish' || $request->input('button') === 'draft' ? 0 : 1;

            $data['created_by'] = auth()->guard('admin')->user()->id;
            $book = $this->repository->create($data);
            $book->authors()->sync($request->input('author_id'));
            return response()->json(['msg' => 'Data created successfully'], 201);
        } catch (\Exception $exception) {
            //Log::error('Failed to create books: ' . $exception->getMessage());
            return response()->json(['error' => 'Failed to create books.'], 500);
        }
    }



    public function edit($id) {
        try {
            $books = $this->repository->find($id);
            $getCategories = Category::getCategories();
            return view('backend.books.edit', compact('books', 'getCategories'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'An error occurred while fetching the data.');
        }
    }

    public function update(BooksRequest $request, $id) {
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $data['image'] = ImageHelper::handleUpdatedUploadedImage($file, 'images', $data, 'images/', 'image');
            }

            $data['status'] = $request->input('button') === 'unpublish' || $request->input('button') === 'draft' ? 0 : 1;
            $data['updated_by'] = auth()->guard('admin')->user()->id;

            $book = $this->repository->find($id);
            $book->update($data);
            if($request->has('author_id')) {
              $book->authors()->sync($request->input('author_id'));
            } else {
              $book->authors()->detach();
            }

            return redirect()->route('books.index')->with('toastr_message', 'Data updated successfully');
        } catch (\Exception $exception) {
            Log::error('Failed to create books: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the data.');
        }
    }



  public function destroy($id){
        try {
            $books = $this->repository->find($id);
            if ($books) {
                $booksData = $books->toArray();
                BooksAuthors::where('book_id', $booksData['id'])->delete();
                $isDeleted = $this->repository->delete($id);
                if ($isDeleted) {
                    ImageHelper::handleDeletedImage($booksData, 'image', 'images/');
                    return back()->with('toastr_message', 'Data deleted successfully');
                } else {
                    return back()->with('toastr_message', 'Failed to delete data');
                }
            } else {
                return back()->with('toastr_message', 'Data not found');
            }
        } catch (ModelNotFoundException $e) {
            return back()->with('toastr_message', 'Data not found');
        } catch (\Exception $e) {
            return back()->with('toastr_message', 'An error occurred while deleting the data');
        }
    }


     public function booksStatus(Request $request){
        try {
            $status = $request->input('status');
            $id = $request->input('id');
            $dataStatus = $this->repository->find($id);
            if ($dataStatus) {
                $dataStatus->status = $status;
                $dataStatus->save();
                return response()->json(['msg' => 'Status changed successfully'], 200);
            } else {
                return response()->json(['msg' => 'Page not found'], 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Page not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function changeTypebooks (Request $request, $id){
    $books = Books::findOrFail($id);
    $this->validate($request, [
        'type' => 'required|in:Popular,Latest,Upcoming,Normal',
    ]);
    $books->type = $request->input('type');
    $books->save();
    return back()->with('toastr_message', 'Item changed successfully');
}

}
