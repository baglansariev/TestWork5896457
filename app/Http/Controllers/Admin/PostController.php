<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Все записи',
            'posts' => Post::paginate(15),
        ];

        return view('admin.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Добавление новой записи',
            'categories' => Category::all(),
        ];

        return view('admin.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has(['title', 'category_id', 'body'])) {

            $post = Post::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'body' => $request->body,
            ]);

            if ($file = $request->file('image')) {
                $image_dir = 'images/posts/' . $post->id . '/';
                $file->move($image_dir, $file->getClientOriginalName());

                $post->image = $image_dir . $file->getClientOriginalName();
            }

            if ($post->save()) {
                $request->session()->flash('msg_success', 'Запись успешно создана');
            }
            else {
                $request->session()->flash('msg_error', 'Ошибка! Попробуйте позже.');
            }


        }
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $data = [
            'title' => 'Изменение записи ' . $post->name,
            'post' => $post,
            'categories' => Category::all(),
        ];

        return view('admin.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($request->has(['title', 'category_id', 'body'])) {

            $post->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'body' => $request->body,
            ]);

            if ($file = $request->file('image')) {
                $image_dir = 'images/posts/' . $post->id . '/';
                $file->move($image_dir, $file->getClientOriginalName());

                $post->image = $image_dir . $file->getClientOriginalName();
            }

            if ($post->save()) {
                $request->session()->flash('msg_success', 'Запись успешно изменена');
            }
            else {
                $request->session()->flash('msg_error', 'Ошибка! Попробуйте позже.');
            }


        }
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if (file_exists($post->image)) unlink($post->image);

        if ($post->delete()) {
            $request->session()->flash('msg_success', 'Запись успешно удалена');
        }
        else {
            $request->session()->flash('msg_error', 'Ошибка! Попробуйте позже.');
        }

        return redirect()->route('post.index');
    }
}
