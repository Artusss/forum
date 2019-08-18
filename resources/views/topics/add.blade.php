@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Add new topic:</h2>
                <form action="{{ url('/new-topic') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" required name="title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="body">Text:</label>
                        <textarea name="body" required class="form-control" rows="10">
                            {{ old('body') }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Text:</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="create" value="create">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection