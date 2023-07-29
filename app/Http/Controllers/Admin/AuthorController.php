<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Repositories\Author\AuthorInterface;
use App\Http\Requests\AuthorRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class AuthorController extends Controller
{
    

    private $repository;
    public function __construct(AuthorInterface $repository){
        $this->repository = $repository;
        $this->middleware('auth:admin');
    }

    public function index(){
        $data['authors'] = $this->repository->getAll();
        return view('backend.author.index', $data);
    }

     public function store(AuthorRequest $request){
        try {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                $data['image'] = ImageHelper::handleUploadedImage($request->file('image'), 'images');
            }
            $author = $this->repository->create($data);
            return response()->json(['msg' => 'Data created successfully'], 201);
        } catch (\Exception $exception) {
            //Log::error('Failed to create author: ' . $exception->getMessage());
            return response()->json(['error' => 'Failed to create author.'], 500);
        }
    }


    public function update(Request $request, $id){
        try {
            $data = $request->except('_token', '_method');
            if ($request->hasFile('image')) {
             $file = $request->file('image');
             $data['image'] = ImageHelper::handleUpdatedUploadedImage($file, 'images', $data, 'images/', 'image');
             }
             $authors = $this->repository->update($id, $data);
             return redirect()->route('author.index')->with('toastr_message', 'Data updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the data.');
        }
    }


    public function destroy($id){
        try {
            $authors = $this->repository->find($id);
            if ($authors) {
                $authorsData = $authors->toArray();
                $isDeleted = $this->repository->delete($id);
                if ($isDeleted) {
                    ImageHelper::handleDeletedImage($authorsData, 'image', 'images/');
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

    public function authorStatus(Request $request){
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

}
