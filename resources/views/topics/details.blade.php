@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                {{-- Session Logs --}}
                <div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif
                </div>
                {{-- Error Logs --}}
                <div>
                    @if ($errors->count())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong>
                            @foreach ($errors->all() as $error)
                                <p class="m-0 p-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p class="m-0">Topic - {{ $topic->title }}</p>
                        <div>
                            <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h1 class="text-center">{{ $topic->title }}</h1>
                        <div class="text-center">
                            <img class="img-fluid" src="{{ asset('/photos/' . $topic->photo) }}" alt="Topic's Image">
                        </div>
                        <hr>
                        <h4 class="my-4">{{ $topic->description }} - {{ $topic->user->username }}</h4>
                        <div class="text-right">
                            <small class="text-mute">{{ ucfirst($topic->category->name) }}</small>
                            <br>
                            <small class="text-mute">{{ $topic->created_at }}</small>
                            <br>
                        </div>
                        <hr>
                        <div class="card my-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @auth
                                            <form action="{{ route('comment.store', $topic->id) }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="2" id="comment" name="comment"
                                                        placeholder="Write a comment.">{{ old('comment') }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-purple">Add Comment</button>
                                            </form>
                                        @else
                                            <form>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="2"
                                                        placeholder="Please login to write comment." disabled></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-purple" disabled>Add Comment</button>
                                            </form>
                                        @endauth
                                        <hr>
                                        @if ($topic->comments->count())
                                            @foreach ($topic->comments as $comment)
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <h5>{{ $comment->user->username }}</h5>
                                                        <p>
                                                            {{ $comment->content }}
                                                        </p>
                                                        <small class="text-mute float-right">
                                                            {{ $comment->created_at }}
                                                        </small>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5>There are no comments, go ahead and write one!</h5>
                                                </div>
                                            </div>
                                        @endif
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
