@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
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
                                    <a href="{{ route('topics.review') }}" class="btn btn-sm btn-success">
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
                        All topics.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
