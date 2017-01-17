@extends('layouts.app')

@section('title', '| Edit posts')

@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')

    <div class="container">
        <div class="row">
            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
            <div class="col-md-8">
                {{ Form::label('title', 'Title:')}}
                {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255'))}}

                {{ Form::label('slug', 'Slug:')}}
                {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minLength' => '5', 'maxlength' => '255'))}}

                {{ Form::label('catagory_id', 'Category:')}}
                {{ Form::select('category_id', $categories, null, array('class' => 'form-control')) }}

                {{ Form::label('tags', 'Tags:') }}
                {{ Form::select('tags', $tags, null, array('class' => 'form-control select2-multi', 'multiple' => 'multiple', 'name' => 'tags[]')) }}

                {{ Form::label('body', 'Post body:')}}
                {{ Form::textarea('body', null,  array('class' => 'form-control', 'required' => '')) }}
            </div>
            <div class="col-md-4">
                <div class="well">
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
                            {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')); !!}
                        </div>
                        <div class="col-sm-6">
                            {{ Form::submit('Save', array('class' => 'btn btn-success btn-block')) }}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection

@section('scripts')
    {!! Html::script('js/select2.min.js') !!}
    <script type="text/javascript">
        $(document).ready(function() {
          $(".select2-multi").select2();
          $(".select2-multi").select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
        });
    </script>
@endsection
