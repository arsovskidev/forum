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
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p class="m-0">My Topics</p>
                        <div>
                            <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">
                                Back
                            </a>
                        </div>
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
                                                <span class="badge badge-secondary my-3">
                                                    Comments {{ $topic->comments->count() }}
                                                </span>
                                                @switch($topic->status)
                                                    @case('approved')
                                                        <h6 class="card-subtitle text-success">
                                                            {{ ucfirst($topic->status) }}
                                                        </h6>
                                                    @break
                                                    @case('refused')
                                                        <h6 class="card-subtitle text-danger">
                                                            {{ ucfirst($topic->status) }}
                                                        </h6>
                                                    @break
                                                    @default
                                                        <h6 class="card-subtitle text-info">
                                                            {{ ucfirst($topic->status) }}
                                                        </h6>
                                                @endswitch

                                            </div>
                                            <div class="col-md-4 my-auto">
                                                <p class="text-right">
                                                    {{ ucfirst($topic->category->name) }} |
                                                    {{ $topic->user->username }}
                                                </p>
                                                <div class="float-right">
                                                    <a href="{{ route('topics.show', $topic->id) }}"
                                                        class="btn btn-sm btn-purple">
                                                        Read More
                                                    </a>
                                                    <a href="{{ route('topics.edit', $topic->id) }}"
                                                        class="btn btn-sm btn-purple">
                                                        Edit
                                                    </a>
                                                    <a href="{{ route('topics.destroy', $topic->id) }}"
                                                        class="btn btn-sm btn-dark">
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="m-0">It appears that you don't have any topics created.
                                <a href="{{ route('topics.create') }}">Go create one right now!
                                </a>
                            </p>


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
