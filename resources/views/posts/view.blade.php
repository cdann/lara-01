@extends('layout')

@section('content')
<div class="col-md-8 col-md-offset-2">

<a href = '{{URL::route("AllPost")}}'> tout voir </a>
<h1>{{$post->name}}</h1>
<p> {{$post->content}} </p>

<a href = '{{URL::route("PostEdit", $post->id)}}'> editer l'article </a>
</div>
@endsection
