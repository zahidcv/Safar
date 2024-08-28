<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PMController extends Controller
{
    public function index(){
        return view("index");
    }
}
