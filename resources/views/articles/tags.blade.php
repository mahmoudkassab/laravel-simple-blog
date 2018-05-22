@extends('layouts.app')

@section('title')
    All Tags
@stop

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Tag URL</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>
                    <a href="{{ route('tagShow', $tag->name) }}">{{ $tag->name }}</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@stop