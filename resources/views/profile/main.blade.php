@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2>{{ $user->name }}</h2>
                <h5>{{ $user->email }}</h5>
            </div>
            <div class="col-md-9">
                @if(Auth::user()->can('create', App\Topic::class))
                    <h3>Topics:</h3>
                    @if($topics->count() === 0)
                        You don't have topics yet. <a href="{{ url('/new-topic') }}">Create</a>
                    @else
                        <div class="container">
                            <div class="row">
                                @foreach($topics as $topic)
                                    <div class="col-md-7">
                                        <a href="{{ url('topic/'.$topic->slug) }}">{{ $topic->title }}</a>
                                    </div>
                                    <div class="col-md-5">
                                        , <em>{{ $topic->created_at }}</em>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ url('profile/my/topics') }}">More topics...</a>
                    @endif
                @endif
                <h3>Decisions:</h3>
                @if($decisions->count() === 0)
                    You don't have decisions yet.
                @else
                    @foreach($decisions as $decision)
                        {{ str_limit($decision->body, 150, '...') }}<br/>
                        , on <a href="{{ url('topic/'.$decision->topic->slug) }}">{{ $decision->topic->title }}</a>, <em>{{ $decision->created_at }}</em><br/>
                    @endforeach
                    <a href="{{ url('profile/my/decisions') }}">More decisions...</a>
                @endif
            </div>
        </div>
    </div>
@endsection