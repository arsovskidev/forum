<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicCreateRequest;
use App\Http\Requests\TopicUpdateRequest;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
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

    public function create()
    {
        $categories = Category::get();

        return view('topics.create', compact('categories'));
    }

    public function store(TopicCreateRequest $request)
    {
        $category = Category::where('id', $request->category)->first();
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

    public function show($id)
    {
        $topic = Topic::where('id', $id)->first();

        if ($topic === null) {
            return back()
                ->with('error', 'The topic does not exist, or it has been deleted.');
        }
        if ($topic->status != 'approved') {
            if (!Auth::check()) {
                return redirect()
                    ->route('home.index')
                    ->with('error', 'Please login to see not approved topics.');
            }
            if (Auth::user()->role->type != 'admin' && Auth::user()->id != $topic->user->id) {
                return redirect()
                    ->route('home.index')
                    ->with('error', 'You don\'t have rights to view this topic.');
            }
        }

        return view('topics.details', compact('topic'));
    }

    public function edit($id)
    {
        $topic = Topic::where('id', $id)->first();

        if ($topic === null) {
            return back()
                ->with('error', 'The topic does not exist, or it has been already deleted.');
        }
        if (Auth::user()->role->type != 'admin' && Auth::user()->id != $topic->user->id) {
            return back()
                ->with('error', 'You don\'t have rights to edit this topic.');
        }

        $categories = Category::get();

        return view('topics.edit', compact('topic', 'categories'));
    }

    public function update(TopicUpdateRequest $request, $id)
    {
        $topic = Topic::where('id', $id)->first();

        if ($topic === null) {
            return back()
                ->with('error', 'The topic does not exist, or it has been already deleted.');
        }
        if (Auth::user()->role->type != 'admin' && Auth::user()->id != $topic->user->id) {
            return back()
                ->with('error', 'You don\'t have rights to edit this topic.');
        }

        if ($request->photo != '') {
            $photos_path = public_path('photos');

            // Remove old photo.
            if ($topic->photo != '' && $topic->photo != null) {
                $photo_old = $topic->photo;
                unlink($photos_path . '/' . $photo_old);
            }

            // Upload new photo.
            $photo_new = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move($photos_path, $photo_new);

            $topic->photo = $photo_new;
        }

        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->category_id = $request->category;
        $topic->status = 'pending';

        // Approve right away if admin edited.
        if (Auth::user()->role->type === 'admin') {
            $topic->status = 'approved';
            $topic->update();

            return redirect()
                ->route('home.index')
                ->with('success', 'Topic successfully edited!');
        }

        $topic->update();

        return redirect()
            ->route('topics.dashboard')
            ->with('success', 'Topic successfully edited! It needs to be approved again though!');
    }

    public function destroy($id)
    {
        $topic = Topic::where('id', $id)->first();
        if ($topic === null) {
            return back()
                ->with('error', 'The topic does not exist, or it has been already deleted.');
        }
        if (Auth::user()->role->type != 'admin' && Auth::user()->id != $topic->user->id) {
            return back()
                ->with('error', 'You don\'t have rights to delete this topic.');
        }

        // Remove old photo.
        if ($topic->photo != '' && $topic->photo != null) {
            $photos_path = public_path('photos');
            $photo_old = $topic->photo;
            unlink($photos_path . '/' . $photo_old);
        }

        $topic->delete();

        return back()
            ->with('success', 'The topic was successfully deleted.');
    }

    public function approve($id)
    {
        $topic = Topic::where('id', $id)->first();

        if ($topic === null) {
            return back()
                ->with('error', 'The topic does not exist, or it has been deleted.');
        }
        if ($topic->status === 'approved') {
            return back()
                ->with('error', 'The topic was already approved.');
        }

        $topic->status = 'approved';
        $topic->save();

        return redirect()
            ->route('topics.review')
            ->with('success', 'The topic was successfully approved.');
    }

    public function refuse($id)
    {
        $topic = Topic::where('id', $id)->first();

        if ($topic === null) {
            return redirect()
                ->route('topics.review')
                ->with('error', 'The topic does not exist, or it has been deleted.');
        }
        if ($topic->status === 'refused') {
            return redirect()
                ->route('topics.review')
                ->with('error', 'The topic was already refused.');
        }

        $topic->status = 'refused';
        $topic->save();

        return redirect()
            ->route('topics.review')
            ->with('success', 'The topic was successfully refused.');
    }
}
