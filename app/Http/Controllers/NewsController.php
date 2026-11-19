<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Text;

class NewsController extends Controller
{
    public function index()
    {
        $texts = Text::with(['category', 'author'])
            ->where('is_blocked', false)
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('home', compact('texts'));
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);

        $texts = Text::with(['category', 'author'])
            ->where('category_id', $id)
            ->where('is_blocked', false)
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('category', compact('texts', 'category'));
    }
}