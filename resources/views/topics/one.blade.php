@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h5>{{ $topic->author->name }}</h5>
                <h1>
                    @if(Auth::user() && Auth::user()->can('smashLike', $topic))
                        <form action="{{ url('topic/'.$topic->slug.'/smash-like') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $topic->id }}">
                            <div class="form-group">
                                <input type="submit" @if(App\Like::where(['author_id' => Auth::id(), 'topic_id' => $topic->id])->first())style="color: #007bff"@endif name="Like" value="{{ $topic->rating }}">
                            </div>
                        </form>
                    @else {{ $topic->rating }} @endif
                </h1>
                <h3>
                    @if(Auth::user() && Auth::user()->can('delete', $topic))
                        <form action="{{ url('topic/'.$topic->slug.'/delete') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $topic->id }}">
                            <div class="form-group">
                                <button><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </form>
                        <a href="{{ url('/edit-topic/'.$topic->id) }}"><i class="fas fa-edit"></i></a>
                    @endif
                </h3>
                <em>{{ $topic->created_at }}</em>
            </div>
            <div class="col-md-10">
                <h3>{{ $topic->title }}<em># {{ $topic->id }}</em></h3>
                <h4>{{ $topic->body }}</h4>
            </div>
            @foreach($decisions as $decision)
                <div class="col-md-2">
                    <h5>{{ $decision->author->name }}</h5>
                    <h3>
                        @if(Auth::user() && Auth::user()->can('delete', $decision))
                            <form action="{{ url('topic/'.$topic->slug.'/delete-dec') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $decision->id }}">
                                <div class="form-group">
                                    <button><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </form>
                        @endif
                    </h3>
                    <em>{{ $decision->created_at }}</em>
                </div>
                <div class="col-md-10">
                    <h5>{{ $decision->body }}</h5>
                </div>
            @endforeach
            {{ $decisions->links() }}
            <div class="col-md-12">
                <form action="{{ url('topic/'.$topic->slug.'/make-dec') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $topic->id }}">
                    <div class="form-group">
                        <textarea name="body" class="form-control" rows="3">
                        {{ old('body') }}
                    </textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection