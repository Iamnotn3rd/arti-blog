@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card my-4">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <span class="card-subtitle text-muted my-2">{{ $article->created_at->diffForHumans() }}</span>
            <span class="badge bg-dark text-white mx-3 mb-3">{{ $article->category->name }}</span>
            <p class="card-text">{{ $article->body }}</p>
            <a href="{{ url(" /articles/delete/$article->id") }}" class="btn btn-danger">Delete</a>
            <a href="{{ url(" /articles/edit/$article->id") }}" class="btn btn-warning">Edit</a>
        </div>
    </div>

    <ul class="list-group">
        <li class="list-group-item active">
            <b>Comments <span class="badge bg-dark text-white">{{ count($article->comments) }}</span></b>
        </li>
        @foreach ($article->comments as $comment)
            <li class="list-group-item">
                <p class="d-inline-block">{{ $comment->content }}</p>
                <a href="{{ url("/comments/delete/$comment->id") }}" class="btn btn-outline-danger float-end d-inline-block">Delete</a>
            </li>
        @endforeach
    </ul>

    <form action="{{ url('/comments/add') }}" method="post">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <textarea name="content" class="form-control mt-4 mb-2" placeholder="New Comment"></textarea>
        <input type="submit" value="Add Comment" class="btn btn-secondary">
    </form>
</div>
@endsection