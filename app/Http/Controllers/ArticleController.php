<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Text;
use Illuminate\Http\Request;
class ArticleController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('journalist', compact('categories'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'heading' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'text' => 'required|string',
        ]);
        $data['user_id'] = auth()->id();
        $data['is_blocked'] = false;
        Text::create($data);
        return redirect()->route('home')->with('success', 'Статья опубликована!');
    }
}