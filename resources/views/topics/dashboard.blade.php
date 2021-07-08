@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p class="m-0 p-0">{{ __('My Topics') }}</p>
                        <div>
                            <a href="{{ route('home.index') }}" class="btn btn-sm btn-danger">
                                {{ __('Back') }}
                            </a>
                        </div>
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
                                        <div>
                                            <p class="text-right">
                                                {{ ucfirst($topic->category->name) }} | {{ $topic->user->name }}
                                            </p>
                                            <div class="float-right">
                                                <a href="#" class="btn btn-sm btn-dark">Delete</a>
                                                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{ __('It appears that you don\'t have any topics created. Go create one right now!') }}
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
