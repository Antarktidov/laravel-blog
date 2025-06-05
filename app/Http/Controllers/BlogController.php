<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;

class BlogController extends Controller
{
    public function create()
    {
        return view('crete-blog');
    }
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'string|required',
            'text' => 'string|required',
        ]);

        $user_id = auth()->user()->id;

        $blog = [
            'title' => $data['title'],
            'content' => $data['text'],
            'author_id' => $user_id,
        ];

        Blog::create($blog);

        return 'Блог успешно создан!';
    }

    public function index()
    {
        $blog = Blog::all();
        return view('blog-index', compact('blog'));
    }

    public function show(Blog $blog)
    {
        return view('blog-show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('blog-edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = request()->validate([
            'title' => 'string|required',
            'text' => 'string|required',
        ]);

        $blog_data = [
            'title' => $data['title'],
            'content' => $data['text'],
        ];

        $blog->update($blog_data);

        return 'Блог успешно обновлён!';
    }

    public function delete(Blog $blog)
    {
        $blog->delete();
        return 'Блог успешно удалён';
    }
}
