@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                {{-- Errors --}}
                <div>
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p class="m-0 p-0">{{ __('All Topics') }}</p>
                        @auth
                            <div>
                                @if (Auth::user()->role->type == 'admin')
                                    <a href="{{ route('topics.review') }}" class="btn btn-sm btn-primary">
                                        {{ __('Review topics') }}
                                    </a>
                                @endif
                                <a href="{{ route('topics.create') }}" class="btn btn-sm btn-dark">
                                    {{ __('Create new') }}
                                </a>
                                <a href="{{ route('topics.dashboard') }}" class="btn btn-sm btn-dark">
                                    {{ __('My topics') }}
                                </a>
                            </div>
                        @endauth
                    </div>
                    <div class="card-body">
                        @if ($topics->count())
                            @foreach ($topics as $topic)
                                <div class="card mb-4">
                                    <div class="card-body d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">
                                                {{ $topic->title }}
                                            </h5>
                                            <p class="card-text">
                                                {{ $topic->description }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-right">
                                                {{ ucfirst($topic->category->name) }} | {{ $topic->user->name }}
                                            </p>
                                            @auth
                                                @if (Auth::user()->role->type == 'admin' || Auth::user()->id == $topic->user->id)
                                                    <div class="float-right">
                                                        <a href="#" class="btn btn-sm btn-dark">Delete</a>
                                                        <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{ __('There is no topics available.') }}
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
