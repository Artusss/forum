@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h3>Categories:</h3>
                <div class="container">
                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-4">
                                <a href="{{ url('/category/'.$category->slug) }}"><h3>{{ $category->title }}<em>#{{ $category->id }}</em></h3></a>
                                @foreach($category->topics as $topic)
                                    <a href="{{ url('topic/'.$topic->slug) }}">{{ $topic->title }} # {{ $topic->id }}</a><br/>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection