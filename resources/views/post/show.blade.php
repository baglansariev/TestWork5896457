@extends('layouts.default')


@section('content')

    <section class="post-section pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="card mb-3">
                    <div class="card-header">
                        <img class="card-img-top" src="{{ asset($post->image) }}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection