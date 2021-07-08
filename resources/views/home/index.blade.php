@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                {{-- Session Logs --}}
                <div>
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p class="m-0">All Topics</p>
                        @auth
                            <div>
                                @if (Auth::user()->role->type == 'admin')
                                    <a href="{{ route('topics.review') }}" class="btn btn-sm btn-purple">
                                        Review topics <span class="badge badge-light">{{ $pending_topics_count }}</span>
                                    </a>
                                @endif
                                <a href="{{ route('topics.create') }}" class="btn btn-sm btn-dark">
                                    Create new
                                </a>
                                <a href="{{ route('topics.dashboard') }}" class="btn btn-sm btn-dark">
                                    My topics
                                </a>
                            </div>
                        @endauth
                    </div>
                    <div class="card-body">
                        @if ($topics->count())
                            @foreach ($topics as $topic)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2 my-auto">
                                                <img class="img-thumbnail" src="{{ asset('/photos/' . $topic->photo) }}"
                                                    alt="Topic's Image">
                                            </div>
                                            <div class="col-md-6 my-4 my-md-auto">
                                                <h5 class="card-title">
                                                    {{ $topic->title }}
                                                </h5>
                                                <p class="card-text">
                                                    {{ \Illuminate\Support\Str::limit($topic->description, 100, $end = '...') }}
                                                </p>
                                            </div>
                                            <div class="col-md-4 my-auto">
                                                <p class="text-right">
                                                    {{ ucfirst($topic->category->name) }} |
                                                    {{ $topic->user->name }}
                                                </p>
                                                <div class="float-right">
                                                    <a href="{{ route('topics.show', $topic->id) }}"
                                                        class="btn btn-sm btn-purple">
                                                        Read More
                                                    </a>
                                                    @auth
                                                        @if (Auth::user()->role->type == 'admin' || Auth::user()->id == $topic->user->id)
                                                            <a href="#" class="btn btn-sm btn-purple">Edit</a>
                                                            <a href="{{ route('topics.destroy', $topic->id) }}"
                                                                class="btn btn-sm btn-dark">
                                                                Delete
                                                            </a>
                                                        @endif
                                                    @endauth
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                            @endforeach
                        @else
                            <p class="m-0">There is no topics available</p>
                        @endif
                        <div class="d-flex justify-content-center">
                            {!! $topics->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
