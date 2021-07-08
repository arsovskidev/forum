<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $topics = Topic::where('status', 'approved')->orderBy('created_at', 'desc')->paginate(5);

        $pending_topics = Topic::where('status', 'pending')->get();
        $pending_topics_count = $pending_topics->count();

        return view('home.index', compact('topics', 'pending_topics_count'));
    }
}
