@extends('layout')

@section('content')
<div class="col-md-8 col-md-offset-2">

<h1> Tous les articles </h1>

@foreach($posts as $post)
	<article>
	<h2>
		<a href='{{URL::secure(URL::route("PostView", array("post" => $post->slug )))}}'>
		{{ $post->name }}
		</a>
	</h2>
	{{ $post->content }}</article>

@endforeach
</div>
@endsection
