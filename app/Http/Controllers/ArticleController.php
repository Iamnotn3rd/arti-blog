<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index() {
        $data = Article::latest()->paginate(5);

        return view('articles.index', [
            'articles' => $data,
        ]);
    }

    public function detail($id) {
        $article = Article::find($id);

        return view('articles.detail', [
            'article' => $article,
        ]);
    }

    public function add() {
        $data = [
            ['id' => 1, 'name' => 'News'],
            ['id' => 2, 'name' => 'Tech'],
        ];

        return view('articles.add', [
            'categories' => $data,
        ]);
    }

    public function create(Request $request) {
        // # request()
        // $article = new Article;
        // $article->title = request()->title;
        // $article->body = request()->body;
        // $article->category_id = request()->category_id;
        // $article->save();
        // return redirect('/articles');

        # using Request Object
        $validator = validator($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        $article->category_id = $request->input('category_id');
        $article->save();
        
        return redirect('/articles');
    }

    public function edit($id) {
        $data = [
            ['id' => 1, 'name' => 'News'],
            ['id' => 2, 'name' => 'Tech'],
        ];

        $article = Article::find($id);

        return view('articles.edit', [
            'categories' => $data,
            'article' => $article,
        ]);
    }

    public function update($id, Request $request) {
        $article = Article::find($id);
        
        $validator = validator($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article->title = old($article->title) ?? $request->input('title');
        $article->body = old($article->body) ?? $request->input('body');
        $article->category_id = old($article->category_id) ?? $request->input('category_id');
        $article->save();

        return redirect("/articles/detail/$article->id");
    }

    public function delete($id) {
        $article = Article::find($id);
        $article->delete();
        
        return redirect('/articles')->with('info', 'Article deleted');
    }
}
