@extends('layouts.app')

@section('title')
    Article
@stop

@section('content')
    <h2>Show one Articles</h2>
    <hr>
    <h3>{{ $article->title }}</h3>
    <span>Author: {{ $user->name }}</span>
    <p>{{ $article->body }}</p>
    <hr>

@stop