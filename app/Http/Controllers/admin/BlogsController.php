<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Category;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    public function index()
    {
        $pageTitle = 'Blogs';
        $user = Auth::user();
        $category = Category::where('user_id', $user->id)->get();
        if ($category->isEmpty()) {
            $msg = "Please add your blog category.";
            return redirect()->route('category.index')->with('error', $msg);
        }
        return view('admin.blogs.index')
            ->with('pageTitle', $pageTitle);
    }

    public function create()
    {
        $pageTitle = 'Create Blogs';
        $user = Auth::user();
        $category = Category::where('user_id', $user->id)->get();
        return view('admin.blogs.add_edit')
            ->with('pageTitle', $pageTitle)
            ->with('category', $category);
    }
}
