<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use App\Models\admin\Category;


class CategoryController extends Controller
{
    public function index(Request $request){
        try{
            $search = '';
            $resultsPerPage = 10;

            $query = Category::query();

            if (isset($request['search']) && !empty($request['search'])) {
                $search = $request['search'];
                $query->where('category_type', 'like', "%$search%");
            }

            $user = Auth::User();
            $results = $query->where('user_id', $user->id)->paginate($resultsPerPage);

            $pageTitle = 'Category';
            return view('admin.category.index')
                ->with('pageTitle', $pageTitle)
                ->with('results', $results)
                ->with('search', $search);

        }catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function create($id = null){
        $data = '';
        $pageTitle = 'Create Category';
        if(isset($id) && !empty($id)){
            $pageTitle = 'Edit Category';
            $id = decrypt($id);
            $data = Category::find($id);
        }
        return view('admin.category.add_edit')
                ->with('pageTitle', $pageTitle)
                ->with('id', $id)
                ->with('data', $data);
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = Auth::user();

            $category = new Category();
            if(isset($request['url_string']) && !empty($request['url_string'])){
                $id = decrypt($request['url_string']);
                $category = Category::find($id);
            }
            $category->category_type = $request['title'];
            $category->user_id = $user->id;
            $category->save();

            if(isset($request['url_string']) && !empty($request['url_string'])){
                $msg = "' " . $category->category_type . " ' category updated successfully";
                return redirect()->route('category.index')->with('success', $msg);
            }else{
                $msg = "' " . $category->category_type . " ' category added successfully";
                return redirect()->route('category.index')->with('success', $msg);
            }

        }catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }
    }

    public function delete($id){
        try{
            $id = decrypt($id);
            $category = Category::find($id);
            $category->delete();
            $msg = "' " . $category->category_type . " ' category deleted successfully";
            return redirect()->route('category.index')->with('success', $msg);
        }catch (\Exception $e) {
            // Handle the exception, log the error, or return an error response
            return redirect::back()->with('error',  $e->getMessage());
        }

    }
}
