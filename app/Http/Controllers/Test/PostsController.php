<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;



class PostsController extends Controller
{
	public function index()
	{
		$posts = Post::paginate('5');
		return view('posts.index', compact ('posts'));
	}

	public function view($slug)
	{
		$post = Post::where('slug', $slug)->firstOrFail();
		return view('posts.view', compact ('post'));
	}

	public function edit($id = -1)
	{
		if ($id != -1)
			$post = Post::findOrFail($id);
		else
			$post = new Post;
		return view('posts.edit', compact('post'));
	}

	public function update($id)
	{
		$post = Post::findOrFail($id);
		$post->update(Request::all());
		return ;
	}

	public function create()
	{
		$user = Post::create(Request::all());
	}

}


