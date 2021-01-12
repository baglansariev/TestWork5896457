<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Все категории',
            'categories' => Category::paginate(15),
        ];

        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Создание новой категории',
        ];

        return view('admin.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('title')) {
            $category = new Category();
            $category->title = $request->title;

            if ($request->has('sort_order')) {
                $category->sort_order = $request->sort_order;
            }

            if ($category->save()) {
                $request->session()->flash('msg_success', 'Категория успешно добавлена');
            }
            else {
                $request->session()->flash('msg_error', 'Ошибка! Попробуйте позже.');
            }
        }

        return redirect()->route('category.index');
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
        $category = Category::findOrFail($id);

        $data = [
            'title' => 'Изменение категории ' . $category->name,
            'category' => $category
        ];

        return view('admin.category.edit', $data);
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
        $category = Category::findOrFail($id);

        if ($request->has('title')) $category->title = $request->title;

        if ($request->has('sort_order')) $category->sort_order = $request->sort_order;

        if ($category->save()) {
            $request->session()->flash('msg_success', 'Категория успешно изменена');
        }
        else {
            $request->session()->flash('msg_error', 'Ошибка! Попробуйте позже.');
        }

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        if ($category->posts->count()) {
            $request->session()->flash('msg_error', 'Ошибка! Вы не можете удалить категорию, в которой есть записи.');
            return redirect()->route('category.index');
        }

        if ($category->delete()) {
            $request->session()->flash('msg_success', 'Категория успешно удалена');
        }
        else {
            $request->session()->flash('msg_error', 'Ошибка! Попробуйте позже.');
        }

        return redirect()->route('category.index');
    }
}
