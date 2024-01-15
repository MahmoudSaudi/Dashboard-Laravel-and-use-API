<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyDashboardController extends Controller
{
    public function index(){
        return view('my-dashboard');
    }
    public function welcome(){
        return view('welcome');
    }
}
