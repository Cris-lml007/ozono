<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('home');
    }

    public function staff(){
        return view('staff');
    }

    public function treatment(){
        return view('treatment');
    }

    public function settings(){
        return view('settings');
    }
}
