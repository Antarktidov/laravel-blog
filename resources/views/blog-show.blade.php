@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{$blog->title}}</h2>
    <p>{{$blog->content}}</p>
</div>
@endsection