<?php

namespace App\Http\Controllers;
use App\Models\Department;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }

    public function home()
    {
        $departments = Department::all(); 

        return view('home.index', compact('departments'));
    }
}