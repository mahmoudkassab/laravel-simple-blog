<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Article;
use App\User;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'edit']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::where('published_at', '<', Carbon::now())
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('articles.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->body = $request->body;
        $published_at = $request->published_at_date . ' '. $request->published_at_time;
        $article->published_at = $published_at;
        $article->author_id = $request->user_id;
        $article->slug = str_slug($request->title, '-');
        $article->save();

        session()->flash('flash_message', 'the article has been created');
        session()->flash('flash_message_important', true);

        $tags = $request->tags;
        foreach ($tags as $tag) {
            if (is_numeric($tag))
            {
                $tagArr[] =  $tag;
            }
            else
            {
                $newTag = Tag::create(['name'=>$tag]);
                $tagArr[] = $newTag->id;
            }
        }
        $article->tags()->sync($tagArr);
        return redirect('articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::whereSlug($slug)->firstOrFail();
        $user = User::find($article->author_id);
        return view('articles.show', compact('article', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $user = User::find($article->author_id);
        if ($user->id == Auth::id()){
            $tags = Tag::all();
            return view('articles.edit', compact('article', 'tags'));
        }else {
            return redirect('articles');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->body = $request->body;
        $published_at = $request->published_at_date . ' '. $request->published_at_time;
        $article->published_at = $published_at;
        $article->slug = str_slug($request->title, '-');
        $article->save();

        session()->flash('flash_message', 'the article has been Updated');

        $tags = $request->tags;
        foreach ($tags as $tag) {
            if (is_numeric($tag))
            {
                $tagArr[] =  $tag;
            }
            else
            {
                $newTag = Tag::create(['name'=>$tag]);
                $tagArr[] = $newTag->id;
            }
        }
        $article->tags()->sync($tagArr);
        
        return redirect('articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $user = User::find($article->author_id);
        if ($user->id == Auth::id()) {
            $article->delete();
        }

        return redirect('articles');
    }
}
