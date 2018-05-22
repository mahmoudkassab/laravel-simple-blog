@extends('layouts.app')

@section('title')
    Create A New Article
@stop

@section('content')
    <form action="{{ route('articles.store') }}" method="post" >
        <legend>Create A New Article</legend>
        @include('partials.form')
        <button class="btn btn-primary" type="submit">Create Article</button>
    </form>
    @include('partials.error')
@stop