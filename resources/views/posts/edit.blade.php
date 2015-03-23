
@extends('layout')

@section('content')
<div class="col-md-8 col-md-offset-2">

{!! Form::model($post, array('route' => ['PostUpdate', $post->id], 'class' => 'form')) !!}

	<div class="form-group">
	    {!! Form::label("name", 'Titre', ['class' => 'form-label']) !!}
	    {!! Form::text("name", null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
	    {!! Form::label("slug", 'slug', ['class' => 'form-label']) !!}
	    {!! Form::text("slug", null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
	    {!! Form::label("content", 'contenu', ['class' => 'form-label']) !!}
	    {!! Form::textarea("content", null, ['class' => 'form-control']) !!}
	</div>

	{!! Form::submit() !!}


{!! Form::close() !!}

</div>
@endsection

