@extends('layouts.app')

@section('title', '| View posts')

@section('content')

    @if($post) :

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>{{ $post->title }}</h1>
                {{ $post->body }}
                <hr>
                <div class="tags">
                @foreach ($post->tags as $tags)
                    <span class="label label-default">{{$tags->name}}</span>
                @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="well">
                    <dl class="dl-horizontal">
                        <dt>Slug</dt>
                        <dd><a href="{{ url('blog/' . $post->slug)  }}">{{ $post->slug }}</a></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>category</dt>
                        <dd>{{ $post->category->name }}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Created at:</dt>
                        <dd>{{ date('M j, Y H:i', strtotime($post->created_at)) }}</dd>
                    </dl>

                    <dl class="dl-horizontal">
                        <dt>Last updated:</dt>
                        <dd>{{ date('M j, Y H:i', strtotime($post->updated_at)) }}</dd>
                    </dl>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-success btn-block')); !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) }}
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-12">
                            {!! Html::linkRoute('posts.index', 'See all posts', null, array('class' => 'btn btn-default btn-block')); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Helaas geen post gevonden</h1>
                    <a href="{{ route('posts.index') }}" class="btn btn-default">Ga terug</a>
                </div>
            </div>
        </div>

    @endif

@endsection
