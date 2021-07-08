@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p class="m-0">Topic - {{ $topic->title }}</p>
                        <div>
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark">
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h1 class="text-center">{{ $topic->title }}</h1>
                        <img class="img-fluid" src="{{ asset('/photos/' . $topic->photo) }}" alt="Topic's Image">
                        <hr>
                        <h4 class="my-4">{{ $topic->description }}</h4>
                        <hr>
                        <div class="card my-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @auth
                                            <form action="">
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="2" id="comment" name="comment"
                                                        placeholder="Write a comment.">{{ old('comment') }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-purple">Add Comment</button>
                                            </form>
                                            <hr>
                                        @endauth
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5>Filip Arsovski</h5>
                                                <p>consectetur, adipisci velit, sed quia non numquam eius modi tempora
                                                    incidunt ut labore et dolore magnam aliquam.</p>
                                                <small class="text-mute">Commented on ....</small>
                                            </div>
                                        </div>
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5>Filip Arsovski</h5>
                                                <p>consectetur, adipisci velit, sed quia non numquam eius modi tempora
                                                    incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                                                <small class="text-mute">Commented on ....</small>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
