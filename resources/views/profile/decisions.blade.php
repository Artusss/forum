@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2>{{ $user->name }}</h2>
                <h5>{{ $user->email }}</h5>
            </div>
            <div class="col-md-9">
                <h3>Decisions:</h3>
                @if($decisions->count() === 0)
                    You don't have decisions yet.
                @else
                    @foreach($decisions as $decision)
                        {{ $decision->body }}<br/>
                        <em>, on <a href="{{ url('topic/'.$decision->topic->slug) }}">{{ $decision->topic->title }}</a></em><br/>
                    @endforeach
                    {{ $decisions->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection