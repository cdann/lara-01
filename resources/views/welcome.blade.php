@extends('layout')

@section('content')
<div class="col-md-8 col-md-offset-2 ">
	<div class="text-center" style="font-size:20px;">
		{{ Inspiring::quote() }}
	</div>
	<p style="margin-top:90px; padding:20px; text-align:center">
	@if (Auth::guest())
		Hi you are a visitor let's <a href="{{URL::secure("/user/login")}}"> log in </a> or <a href="{{URL::secure("/user/register")}}">register</a>.
	@elseif(Session::has('Admin'))
		Hi you are an Admin you can go on the <a href="{{URL::secure("/user")}}"> Admin Panel </a> to create, update or delete users.
	@else
		Hi you are an User you can <a href="/user/edit/{{Auth::user()->id}}">edit</a> or <a href="/user/delete/{{Auth::user()->id}}">delete</a> your profile.
	@endif
		</p>
</div>
@endsection


@section('title')
Welcome
@endsection
