@extends('layout')

@section('content')
<div class="col-md-8 col-md-offset-2">

<h1> Tous les utilisateurs </h1>
<a class="btn btn-success" href='{{URL::secure(URL::route('UserEdit',array("id" => -1 ),false))}}'> create </a>


<table class="table">
<tr> <th> id </th> <th> login </th> <th>statut</th> <th>e-mail</th> <th></th><th></th></tr>
@foreach($users as $user)
	<tr>
		<td>
			<a >
			{{ $user->id }}
			</a>
		</td>
		<td>
			{{ $user->name }}
		</td>
		<td>
			{{ $user->statut ? 'Admin' : 'User' }}
		</td>
		<td>
			{{ $user->email }}
		</td>
		<td> <a class="btn btn-block btn-default" href='{{URL::secure(URL::route("UserEdit", array("id" => $user->id ), false))}}'> edit  </a></td>
		<td> <a class="btn btn-block btn-danger" href='{{URL::secure(URL::route("UserDelete", array("id" => $user->id ), false))}}'> delete </a> </td>
	</tr>

@endforeach
</table>
</div>
@endsection
