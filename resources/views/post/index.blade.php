@extends('layouts.default')


@section('content')

    <section class="post-section pt-5 pb-5">
        <div class="container">
            <div class="row">
                @if ($posts->count())
                    @foreach($posts as $post)
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <img class="card-img-top" src="{{ asset($post->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ substr($post->body, 0, 80) . '...' }}</p>
                                    <a href="{{ route('front.post.show', $post->id) }}" class="btn btn-primary">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mb-4 mt-4">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="col-sm-12">
                        <div class="text-center">
                            Пока нет записей. Если вы админ <a href="{{ route('post.create') }}">добавьте запись</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection