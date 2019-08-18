@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Edit your topic #{{ $topic->id }}:</h2>
                <form action="{{ url('/update') }}" method="post">
                    @csrf
                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" required name="title" value="@if(old('title')){{ old('title') }}@else{{ $topic->title }}@endif">
                    </div>
                    <div class="form-group">
                        <label for="body">Text:</label>
                        <textarea name="body" class="form-control" required rows="10">@if(old('body')){{ old('body') }}@else{{ $topic->body }}
                            @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Text:</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($topic->category_id === $category->id) selected @endif>
                                    {{ $category->title }}
                                </option>
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