@extends('layouts.app')


@section('content')

    <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="postTitle">Заголовок</label>
                    <input type="text" id="postTitle" class="form-control" placeholder="Заголовок" name="title" value="{{ $post->title }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="postImage">Изображение</label>
                    <input type="file" id="postImage" class="form-control" name="image">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="postCategory">Категория</label>
                    <select name="category_id" id="postCategory" class="form-control">
                        @if ($categories->count())
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $post->category->id) selected @endif>{{ $category->title }}</option>
                            @endforeach
                        @else
                            <option value="0">Нет</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="postText">Текст</label>
                    <textarea name="body" id="postText" cols="30" rows="10" class="form-control" placeholder="Текст..." required>{{ $post->body }}</textarea>
                </div>
            </div>
        </div>
        <div class="form-actions mt-3 text-right">
            <button type="submit" class="btn btn-success mr-1">Сохранить</button>
            <a href="{{ route('post.index') }}" class="btn btn-danger">Отмена</a>
        </div>
    </form>

@endsection