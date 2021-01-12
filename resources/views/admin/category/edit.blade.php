@extends('layouts.app')


@section('content')

    <form action="{{ route('category.update', $category->id) }}" method="post">
        @method('PUT')
        @csrf

        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="categoryTitle">Название</label>
                    <input type="text" id="categoryTitle" class="form-control" placeholder="Название" name="title" value="{{ $category->title ?? '' }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="categorySort">Порядок</label>
                    <input type="number" id="categorySort" class="form-control" placeholder="Порядок" name="sort_order" value="{{ $category->sort_order ?? 0 }}">
                </div>
            </div>
        </div>
        <div class="form-actions mt-3 text-right">
            <button type="submit" class="btn btn-success mr-1">Сохранить</button>
            <a href="{{ route('category.index') }}" class="btn btn-danger">Отмена</a>
        </div>
    </form>

@endsection