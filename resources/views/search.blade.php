@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Results for: {{ $query }}</h2>
            </div>
            <div class="col-md-6">
                <h3>Topics:</h3>
                @foreach($topics as $topic)
                    <a href="{{ url('topic/'.$topic->slug) }}">{{ $topic->title }} (+{{ $topic->rating }}) #{{ $topic->category->title }}</a><br/>
                @endforeach
            </div>
            <div class="col-md-6">
                <h3>Categories:</h3>
                @foreach($categories as $category)
                    <a href="{{ url('/category/'.$category->slug) }}">{{ $category->title }}<em>#{{ $category->id }}</em></a><br/>
                @endforeach
            </div>
        </div>
    </div>
@endsection