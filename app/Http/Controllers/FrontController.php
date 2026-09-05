<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FrontController extends Controller
{

    public function home(Request $request)
    {

        return view('front-pages.home');
    }


}