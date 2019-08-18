<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Topic;
use App\Decision;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //get auth user profile, GET
    public function index(){
        $user = Auth::user();
        $decisions = Decision::where('author_id', $user->id)
            ->with('topic')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        if($user->can('create', Topic::class)){
            $topics = Topic::where('author_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            return view('profile.main', [
                'user' => $user,
                'topics' => $topics,
                'decisions' => $decisions
            ]);
        }
        return view('profile.main', [
            'user' => $user,
            'decisions' => $decisions
        ]);
    }
    //show all topics of auth user, GET
    public function my_topics(){
        $user = Auth::user();
        if($user->can('create', Topic::class)){
            $topics = Topic::where('author_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('profile.topics', [
                'user' => $user,
                'topics' => $topics,
            ]);
        }
        return redirect('profile')->withErrors(config('app.message.right'));
    }
    //show all decisions of auth user, GET
    public function my_decisions(){
        $user = Auth::user();
        if($user->can('create', Topic::class)){
            $decisions = Decision::where('author_id', $user->id)
                ->with('topic')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
            return view('profile.decisions', [
                'user' => $user,
                'decisions' => $decisions
            ]);
        }
        return redirect('profile')->withErrors(config('app.message.right'));
    }
}
