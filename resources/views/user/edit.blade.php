
@extends('layout')

@section('title')
{{{ $user->id ? 'Mettre a jour l\'utilisateur' :  'Creer un utilisateur' }}}
@endsection


@section('content')
<div class="col-md-8 col-md-offset-2">


{!! Form::model($user, array('url' => $user->id ? URL::secure(URL::route("UserUpdate", $user->id, false)) : URL::secure(URL::route("UserCreate", [], false)) ), ['class' => 'form']) !!}

	<div class="form-group">
	    {!! Form::label("name", 'Login', ['class' => 'form-label']) !!}
	    {!! Form::text("name", null, ['class' => 'form-control']) !!}
	    {!! $errors->first('name', '<div class="form-error">:message</pre>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label("email", 'email', ['class' => 'form-label']) !!}
	    {!! Form::email("email", null, ['class' => 'form-control']) !!}
	    {!! $errors->first('email', '<div class="form-error">:message</pre>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label("password", 'Mot de passe', ['class' => 'form-label']) !!}
	    {!! Form::password("password", ['class' => 'form-control']) !!}
	    {!! $errors->first('password', '<div class="form-error">:message</pre>') !!}
	</div>

	<div class="form-group">
	    {!! Form::label("password_confirmation", 'Confirmation de Mot de passe', ['class' => 'form-label']) !!}
	    {!! Form::password("password_confirmation", ['class' => 'form-control']) !!}
	    {!! $errors->first('password_confirmation', '<div class="form-error">:message</pre>') !!}
	</div>

	@if(Session::has('Admin'))
		<div class="form-group">
		    {!! Form::label("statut", 'statut', ['class' => 'form-label']) !!}
		    {!! Form::select('statut', array(
				'0' => 'user',
				'1' => 'Admin',
				),null,
				['class' => 'form-control'])
			!!}
		</div>
	@endif

	{!! Form::submit(null, ['class' => 'btn btn-primary']) !!}

	@if(!Session::has('Admin'))
		<a class="btn btn-danger" style="float:right; opacity:0.7" href="/user/delete/{{Auth::user()->id}}"> supprimer votre profil </a>
	@endif


{!! Form::close() !!}

</div>
@endsection
