<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create() {
        return view('post.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        return back()->with('message', '保存しました');
    }

    public function index() {
        // ログインしているユーザーの投稿を取得する
        $posts = Post::where('user_id', auth()->id())->get();
        // ログインしていないユーザーの投稿を取得する
        // $posts = Post::where('user_id', '!=', auth()->id())->get();
        return view('post.index', compact('posts'));
    }
}
