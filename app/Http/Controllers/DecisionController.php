<?php
namespace App\Http\Controllers;
use App\Decision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DecisionController extends Controller
{
    //add decision for topic, POST
    public function store(Request $request, $slug){
        $decision = new Decision;
        $decision->author_id = Auth::id();
        $decision->topic_id = $request->id;
        $decision->body = $request->body;
        $decision->save();
        return redirect('topic/'.$slug)
            ->withMessage(config('app.message.create'));
    }
    //delete topic, POST
    public function destroy(Request $request, $slug){
        $decision = Decision::findOrFail($request->id);
        if(Auth::user()->can('delete', $decision)){
            $decision->delete();
            return redirect('topic/'.$slug)
                ->withMessage(config('app.message.delete'));
        }
        return redirect('topic/'.$slug)
            ->withErrors(config('app.message.right'));
    }
}
