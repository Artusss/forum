<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostFormRequest;
use App\User;
use App\Category;
use App\Topic;
use App\Decision;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use sngrl\SphinxSearch\SphinxSearch;

class TopicController extends Controller
{
    //all topics, GET
    public function index(){
        $topics = Topic::with('category')
            ->get();
        $users = User::where('role', 'author')->get();
        $last_topics = $topics
            ->sortByDesc('created_at')
            ->take(10);
        $best_topics = $topics
            ->sortByDesc('rating')
            ->take(10);
        $best_authors = $users
            ->sortByDesc('rating')
            ->take(15);
        $topic_count = $topics->count();
        $decision_count = Decision::count();
        $user_count = User::count();
        return view('home', [
            'last_topics' => $last_topics,
            'best_topics' => $best_topics,
            'best_authors' => $best_authors,
            'topic_count' => $topic_count,
            'decision_count' => $decision_count,
            'user_count' => $user_count,
        ]);
    }
    //show one topic, GET
    public function show($slug){
        $topic = Topic::where('slug', $slug)->first();
        if(!$topic){
            return redirect('/')->withErrors(config('app.message.not_found'));
        }
        $decisions = Decision::where('topic_id', $topic->id)
            ->with('author')
            ->orderBy('created_at')
            ->paginate(5);
        return view('topics.one', [
            'topic' => $topic,
            'decisions' => $decisions,
        ]);
    }
    //show form for create new topic, GET
    public function create(){
        if(Auth::user()->can('create', Topic::class)){
            $categories = Category::all();
            return view('topics.add', [
                'categories' => $categories,
            ]);
        }
        return redirect('/')
            ->withErrors(config('app.message.right'));
    }
    //add new topic, POST
    public function store(PostFormRequest $request){
        $topic = new Topic;
        $topic->author_id = Auth::id();
        $topic->category_id = $request->category_id;
        $topic->title = $request->title;
        $topic->body = $request->body;
        $topic->slug = str_slug($topic->title);
        $topic->save();
        return redirect('topic/'.$topic->slug)
            ->withMessage(config('app.message.create'));
    }
    //show form for edit topic, GET
    public function edit($id){
        $topic = Topic::findOrFail($id);
        if(Auth::user()->can('update', $topic)){
            $categories = Category::all();
            return view('topics.edit', [
                'topic' => $topic,
                'categories' => $categories,
            ]);
        }
        return redirect('/')
            ->withErrors(config('app.message.right'));
    }
    //edit topic, POST
    public function update(Request $request){
        $topic_id = $request->topic_id;
        $topic = Topic::findOrFail($topic_id);
        $topic->category_id = $request->category_id;
        $topic->title = $request->title;
        $topic->body = $request->body;
        $topic->slug = str_slug($topic->title);
        $topic->save();
        return redirect('topic/'.$topic->slug)
            ->withMessage(config('app.message.update'));
    }
    //delete topic, POST
    public function destroy(Request $request){
        $topic = Topic::findOrFail($request->id);
        if(Auth::user()->can('delete', $topic)){
            DB::beginTransaction();
            try{
                $author = User::findOrFail($topic->author_id);
                $topic->delete();
                $author->rating = $author->topics->sum('rating');
                $author->save();
                DB::commit();
            }catch(\Exception $e){
                DB::rollBack();
            }
            return redirect('/')
                ->withMessage(config('app.message.delete'));
        }
        return redirect('/')
            ->withErrors(config('app.message.right'));
    }
    //smash like on the topic, POST
    public function smashLike(Request $request){
        DB::beginTransaction();
        try{
            $topic = Topic::findOrFail($request->id);
            $like = Like::where(['author_id' => Auth::id(), 'topic_id' => $request->id])->first();
            if($like){
                $like->delete();
                $topic->decrement('rating');
            }else{
                $like = new Like;
                $like->author_id = Auth::id();
                $like->topic_id = $topic->id;
                $like->save();
                $topic->increment('rating');
            }
            $author = User::findOrFail($topic->author_id);
            $author->rating = $author->topics->sum('rating');
            $author->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }
        return redirect('topic/'.$topic->slug);
    }

    //Results of sphinx search, POST
    public function search(Request $request){
        $query = $request->input('query');
        $topics = Topic::search($query)->get();
        $categories = Category::search($query)->get();
        return view('search', [
            'query' => $query,
            'topics' => $topics,
            'categories' => $categories,
        ]);
    }
}
