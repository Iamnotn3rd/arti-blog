@extends('layouts.app')


@section('content')
<div class="container">

    @if ($errors->any())
        <div class="alert alert-warning">
            <ol>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    <form method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" id="body" rows="3" name="body"></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="mb-3">Category</label>
            <select name="category_id" id="category" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" value="Add Article" class="btn btn-primary">
    </form>
</div>
@endsection