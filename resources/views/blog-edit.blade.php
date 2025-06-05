@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Править блог</h1>
    <form action="{{route('blog.update', $blog->id)}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название: </label>
            <input type="text" class="form-control" name="title" id="title" value="{{$blog->title}}">
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Содержание блога</label>
            <textarea class="form-control" id="text" name="text" rows="20">{{$blog->content}}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">Сохранить блог</button>
    </form>
</div>
@endsection