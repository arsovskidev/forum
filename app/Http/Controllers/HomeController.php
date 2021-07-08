<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $topics = Topic::where('status', 'approved')->paginate(5);

        return view('home.index', compact('topics'));
    }
}
