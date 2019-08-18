@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Last topics:</h2>
                @foreach($last_topics as $topic)
                    <a href="{{ url('topic/'.$topic->slug) }}">{{ $topic->title }} (+{{ $topic->rating }}) #{{ $topic->category->title }}</a><br/>
                @endforeach <br>
                <h2>The most popular topics:</h2>
                @foreach($best_topics as $topic)
                    <a href="{{ url('topic/'.$topic->slug) }}">{{ $topic->title }} (+{{ $topic->rating }}) #{{ $topic->category->title }}</a><br/>
                @endforeach <br>
            </div>
            <div class="col-md-4">
                Total: <br>
                    {{ $topic_count }} topics,<br>
                    {{ $decision_count }} messages,<br>
                    {{ $user_count }} users<br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <span><h2>Best authors:</h2></span>
                @foreach($best_authors as $user)
                    {{ $user->name }}(+{{ $user->rating }})
                @endforeach
            </div>
        </div>
    </div>
@endsection
