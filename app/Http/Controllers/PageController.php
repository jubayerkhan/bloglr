<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
{
    $name = "Jubayer Khan";
    $age = 22;
    $hobbies = ["Coding", "Football", "Reading", "Movies", "Military History"];

    return view('about', compact('name', 'age', 'hobbies'));
}

}
