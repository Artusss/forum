<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Topic;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    //show all categories and paginate topics, GET
    public function index(){
        $categories = Category::with('topics')
            ->paginate(6);
        return view('categories.all', [
            'categories' => $categories,
        ]);
    }
    //show one category and paginate topics, GET
    public function show($slug){
        $category = Category::where('slug', $slug)->first();
        if(!$category){
            return redirect('/category')->withErrors(config('app.message.not_found'));
        }
        $topics = Topic::where('category_id', $category->id)
            ->with('author')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('categories.one')
            ->withCategory($category)
            ->withTopics($topics);
    }
}
