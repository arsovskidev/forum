<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicCreate;
use App\Http\Requests\TopicCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);

        return view('topics.dashboard', compact('topics'));
    }

    public function review()
    {
        $topics = Topic::where('status', 'pending')->orderBy('created_at', 'desc')->paginate(5);

        return view('topics.review', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        return view('topics.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicCreateRequest $request)
    {
        $category = Category::where('id', '=', $request->category)->first();
        if ($category === null) {
            return back()
                ->with('error', 'Invalid category, try again.');
        }

        $photo = time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('photos'), $photo);

        $topic = new Topic();
        $topic->user_id = Auth::user()->id;

        $topic->title = $request->title;
        $topic->photo = $photo;
        $topic->description = $request->description;
        $topic->category_id = $request->category;
        $topic->save();

        return redirect()
            ->route('topics.dashboard')
            ->with('success', 'Topic successfully created! It needs to be approved before you dig into it though!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::where('id', '=', $id)->first();
        if ($topic === null) {
            return back()
                ->with('error', 'The topic does not exist, or it has been already deleted.');
        }
        if (Auth::user()->role->type != 'admin' || Auth::user()->id != $topic->user->id) {
            return back()
                ->with('error', 'You don\'t have rights to delete this topic.');
        }

        $topic->delete();

        return back()
            ->with('success', 'The topic was successfully deleted.');
    }

    public function approve($id)
    {
        $topic = Topic::where('id', '=', $id)->first();
        if ($topic === null) {
            return back()
                ->with('error', 'The topic does not exist, or it has been deleted.');
        }

        $topic->status = 'approved';
        $topic->save();

        return back()
            ->with('success', 'The topic was successfully approved.');
    }

    public function refuse($id)
    {
        $topic = Topic::where('id', '=', $id)->first();
        if ($topic === null) {
            return back()
                ->with('error', 'The topic does not exist, or it has been deleted.');
        }

        $topic->status = 'refused';
        $topic->save();

        return back()
            ->with('success', 'The topic was refused.');
    }
}
