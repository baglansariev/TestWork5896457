@extends('layouts.app')


@section('content')
    @if (session()->has('msg_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('msg_success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('msg_error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('msg_error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="actions d-flex justify-content-end mb-3">
        <a href="{{ route('post.create') }}" class="btn btn-success">Добавить</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Категория</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Действие</th>
            </tr>
        </thead>
        <tbody>
            @if ($posts->count())
                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->title ?? 'Без категории' }}</td>
                        <td>{{ $post->created_at }}</td>
                        <td>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning mr-1">Изменить</a>
                            <form action="{{ route('post.destroy', $post->id) }}" class="d-inline" method="post">
                                @method('DELETE') @csrf
                                <button class="btn btn-danger" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <th colspan="5" class="text-center">Пока нет записей</th>
                </tr>
            @endif
        </tbody>
    </table>
    @if ($posts->count())
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    @endif

@endsection