@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Блог</h1>
    @foreach($blog as $item)
    <div>
        <h2>{{$item->title}}</h2>
        <p>{{$item->content}}</p>
        @can('delete_blogs')
        <form action="{{route('blog.delete', $item->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Удалить</button>
        </form>
        @endcan
    </div>
    @endforeach
</div>
@endsection