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
                        <p class="m-0">Edit Topic - {{ $topic->title }}</p>
                        <div>
                            <a href="{{ route('home.index') }}" class="btn btn-sm btn-dark">
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <form action="{{ route('topics.update', $topic->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ $topic->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" class="form-control-file" id="photo" name="photo">
                                        <small class="text-mute">If left empty, the old photo will remain.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" rows="2" id="description"
                                            name="description">{{ $topic->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select class="form-control" required id="category" name="category">
                                            @if ($categories->count())
                                                @foreach ($categories as $category)
                                                    @if ($topic->category->name == $category->name)
                                                        <option value="{{ $category->id }}" selected="selected">
                                                            {{ ucfirst($category->name) }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $category->id }}">
                                                            {{ ucfirst($category->name) }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option selected="selected" disabled>
                                                    There is no category available.
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                    <small class="text-danger ">
                                        When editing topic, it needs to be approved again!
                                    </small>
                                    <hr>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-purple">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
