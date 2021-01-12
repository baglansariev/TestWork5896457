<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'PostMaster',
            'posts' => Post::paginate(25),
        ];
        return view('post.index', $data);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'title' => $post->title,
            'post' => $post
        ];

        return view('post.show', $data);
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);

        $data = [
            'title' => $category->title,
            'posts' => $category->posts()->paginate(25),
        ];
        return view('post.index', $data);
    }
}
