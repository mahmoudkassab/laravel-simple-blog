<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{

    public function show(Tag $tag)
    {
        $articles = $tag->articles()->where('published_at', '<', Carbon::now())->orderBy('created_at', 'desc')
            ->get();
        return view('articles.index', compact('articles'));
    }

    public function showAllTags(){
        $tags =  Tag::select('id', 'name')->get();
        return view('articles.tags', compact('tags'));
    }
}
