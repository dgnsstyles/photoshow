@extends('layouts.app')

@section('content')
    <h3>Create album</h3>
    <form class="form-group">
    {!!Form::open(['action' => 'AlbumsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
    <br>
    {{Form::text('name', '', ['placeholder' => 'Album Name'])}}
    <br>
    {{Form::textarea('description', '',['placeholder' => 'Album Description'])}}
    <br>
    {{Form::file('cover_image')}}
    <br>
    {{Form::submit('submit')}}
    {!! Form::close() !!}
    </form>
@endsection