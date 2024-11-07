<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function index()
    {
        $states = State::all(); // Truy vấn tất cả các bang
        return view('layouts.user', compact('states')); // Truyền dữ liệu sang view
    }
}
