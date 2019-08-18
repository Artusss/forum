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
                        {{ $topics->links() }}
                    @endif
                @else
                    {{ redirect('/profile') }}
                @endif
            </div>
        </div>
    </div>
@endsection