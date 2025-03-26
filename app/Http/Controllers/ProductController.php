<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('pages/products');
    }

    public function show($id){
        return view('pages/product-detail', compact('id'));
    }
}
