<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Repositories\Category\CategoryInterface;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    private $repository;
    public function __construct(CategoryInterface $repository){
        $this->repository = $repository;
        $this->middleware('auth:admin');
    }

    public function index(){
        $data['category'] = $this->repository->getAll();
        return view('backend.category.index', $data);
    }

    public function create(){
        $data['getCategories'] = Category::getCategories();
        return view('backend.category.create', $data);
    }

    public function store(CategoryRequest $request){
        try {

            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = ImageHelper::handleUploadedImage($request->file('image'), 'images');
            }

            if (empty($data['meta_title'])) {
                $data['meta_title'] = $data['name'];
            }

            $data['status'] = $request->input('button') === 'unpublish' || $request->input('button') === 'draft' ? 0 : 1;
            $category = $this->repository->create($data);
            return response()->json(['msg' => 'Data created successfully'], 201);
        } catch (\Exception $exception) {
            //Log::error('Failed to create category: ' . $exception->getMessage());
            return response()->json(['error' => 'Failed to create category.'], 500);
        }
    }

     public function edit($id){
        try {
            $category = $this->repository->find($id);
            $getCategories = Category::getCategories();
            return view('backend.category.edit', compact('category','getCategories'));
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'An error occurred while fetching the data.');
        }
    }

   
     public function update(Request $request, $id){
        try {
            $data = $request->except('_token', '_method');
            if ($request->hasFile('image')) {
             $file = $request->file('image');
             $data['image'] = ImageHelper::handleUpdatedUploadedImage($file, 'images', $data, 'images/', 'image');
             }
             $category = $this->repository->update($id, $data);
             return redirect()->route('category.index')->with('toastr_message', 'Data updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the data.');
        }
    }


    public function destroy($id){
        try {
            $category = $this->repository->find($id);
            if ($category) {
                $categoryData = $category->toArray();
                $isDeleted = $this->repository->delete($id);
                if ($isDeleted) {
                    ImageHelper::handleDeletedImage($categoryData, 'image', 'images/');
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

    public function categoryStatus(Request $request){
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

   public function changeTypeCategory(Request $request, $id){
    $category = Category::findOrFail($id);
    $this->validate($request, [
        'type' => 'required|in:Popular,Latest,Upcoming,Normal',
    ]);
    $category->type = $request->input('type');
    $category->save();
    return back()->with('toastr_message', 'Item changed successfully');
}

}
