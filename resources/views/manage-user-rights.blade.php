@extends('layouts.app')

@section('content')
<div class="container">
    <p>ID: {{$user->id}}</p>
    <p>Имя: {{$user->name}}</p>
    <form action="{{route('manage-user-rights.store', $user->id)}}" method="post">
        @csrf
        <div class="form-check">
            <label class="form-check-label" for="is_steward">steward</label>
            <input class="form-check-input" type="checkbox" name="is_steward" id="is_steward" {{$user->is_steward ? 'checked' : ''}}>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="is_admin">admin</label>
            <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin" {{$user->is_admin ? 'checked' : ''}}>
        </div>
        <div class="form-check">
            <label class="form-check-label" for="is_editor">editor</label>
            <input class="form-check-input" type="checkbox" name="is_editor" id="is_editor" {{$user->is_editor ? 'checked' : ''}}>
        </div>
        <button class="btn btn-primary" type="submit">Сохранить права</button>
    </form>
</div>
@endsection
