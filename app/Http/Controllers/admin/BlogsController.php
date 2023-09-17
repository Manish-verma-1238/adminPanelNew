<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index(){
        $pageTitle = 'Blogs';
        return view('admin.blogs.index')
                ->with('pageTitle', $pageTitle);
    }

    public function create(){
        $pageTitle = 'Create Blogs';
        return view('admin.blogs.add_edit')
                ->with('pageTitle', $pageTitle);
    }
}
