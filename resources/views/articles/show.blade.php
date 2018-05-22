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
    @unless($article->tags->isEmpty())
        <p>Tags:</p>
        @foreach($article->tags as $tag)
            <ul>
                <li>{{ $tag->name }}</li>
            </ul>
        @endforeach
    @endunless
    <hr>

@stop