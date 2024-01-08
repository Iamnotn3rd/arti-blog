@extends('layouts.app')

@section('content')

<div class="container">

    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    {{ $articles->links() }}
    @foreach ($articles as $article)
    <div class="card my-4">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <span class="card-subtitle text-muted my-2">
                By - {{ $article->user->name }}, {{ $article->created_at->diffForHumans() }}
            </span>
            <span class="badge bg-dark text-white mx-3 mb-3 text-decoration-none">
                <a href="/categories/{{ $article->category->name }}">{{ $article->category->name }}</a>
            </span>
            <p class="card-text">{{ $article->body }}</p>
            <a href="{{ url("/articles/detail/$article->id") }}" class="btn btn-primary">View Detail &raquo;</a>
        </div>
    </div>
    @endforeach
</div>
@endsection