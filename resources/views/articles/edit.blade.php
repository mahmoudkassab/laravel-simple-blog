@extends('layouts.app')

@section('title')
    Update Article
@stop

@section('content')
    <form action="{{ route('articles.update', $article->id) }}" method="post">
        <legend>Edit Article</legend>
        <input name="_method" type="hidden" value="PUT">
        @include('partials.form')
        <button class="btn btn-primary" type="submit">Update Article</button>
    </form>
    @include('partials.error')
@stop