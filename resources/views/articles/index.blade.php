@extends('layouts.app')

@section('title')
    All Articles
@stop

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Article Title</th>
            <th>Article Body</th>
            <th>Author</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>
                    <a href="#">{{ $article->title }}</a>
                </td>
                <td>{{ $article->body }}</td>
                <td>{{ App\User::find($article->author_id)->name }}</td>
                <td>
                    @if($article->author_id == Auth::id())
                        <a href="{{ route('articles.edit', $article->id) }}"><button type="button" class="btn btn-success">Edit</button></a>
                    @endif
                </td>
                <td>
                    @if($article->author_id == Auth::id())
                        <form method="post" action="{{ route('articles.destroy',$article->id) }}">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@stop