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
    <p>Comments:
    <table class="table table-hover">
        <tbody>
        @foreach($article->comments as $comment)
            <tr>
                <td>{{ $comment->user->name }}:</td>
                <td>
                    {{ $comment->comment }}
                </td>
                <td>
                    @if($comment->user_id == Auth::id())
                        <form method="post" action="{{ route('commentDelete',$comment->id) }}">
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

    <form method="post" action="{{ route('commentStore',$article->id) }}">
        {{ csrf_field() }}
        <input name="article_id" type="hidden" value="{{ $article->id }}">
        <input name="user_id" type="hidden" value="{{ Auth::id() }}">
        <div class="form-group row">
            <label for="body" class="col-sm-2 col-form-label">Add Comment: </label>

            <textarea name="comment" id="comment" cols="1" rows="1" class="form-control"></textarea>
        </div>
        <input type="submit" value="Add comment" class="btn btn-success">
    </form>

@stop