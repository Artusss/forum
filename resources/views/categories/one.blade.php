@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Category {{ $category->title }}:</h3>
            </div>
            @foreach($topics as $topic)
                <div class="col-md-6">
                    <a href="{{ url('/topic/'.$topic->slug) }}">{{ $topic->title }}</a>
                </div>
                <div class="col-md-6">
                    , on {{ $topic->author->name }}, <em>{{ $topic->created_at }}</em>
                </div>
            @endforeach
            {{ $topics->links() }}
        </div>
    </div>
@endsection