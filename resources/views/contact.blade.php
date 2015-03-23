
@extends('layout')

@section('title')
Contactez moi
@endsection

@section('content')
<div class="col-md-8 col-md-offset-2">

{!! Form::open(array('url' => URL::secure(URL::route("ContactPost", [], false)), 'method' => 'post')) !!}

	<div class="form-group">
	    {!! Form::label("title", 'Titre', ['class' => 'form-label']) !!}
	    {!! Form::text("title", null, ['class' => 'form-control']) !!}
	    {!! $errors->first('title', '<div class="form-error">:message</pre>') !!}

	</div>

	<div class="form-group">
	    {!! Form::label("email", 'email', ['class' => 'form-label']) !!}
	    {!! Form::email("email", null, ['class' => 'form-control']) !!}
	    {!! $errors->first('email', '<div class="form-error">:message</pre>') !!}

	</div>

	<div class="form-group">
	    {!! Form::label("content", 'Message', ['class' => 'form-label']) !!}
	    {!! Form::textarea("content", null, ['class' => 'form-control']) !!}
	    {!! $errors->first('content', '<div class="form-error">:message</pre>') !!}
	</div>

	{!! Form::submit(null, ['class' => 'btn btn-primary']) !!}


{!! Form::close() !!}

</div>
@endsection
