<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //direct trend post
    public function index(){
        $postLog = ActionLog::select('action_logs.*','posts.*',
        DB::raw('COUNT(action_logs.new_id) as post_count'))
        ->leftJoin('posts','posts.id','action_logs.new_id')
        ->groupBy('action_logs.new_id')
        ->get();
        // ->paginate(5);

        // dd($postLog->toArray());
        return view('admin.trend_post.index',compact('postLog'));
    }
    //trend post detail
    public function trendPostDetails($id){
        $details = Post::where('id',$id)->first();

        return view('admin.trend_post.detail',compact('details'));
    }



}



















// public function index(){
//     $postLog = ActionLog::select('action_logs.*','posts.*',
//         DB::raw('COUNT(action_logs.new_id) as post_count'))
//         ->leftJoin('posts','posts.id','action_logs.new_id')
//         ->groupBy(
//             'action_logs.id', // Add all relevant columns from action_logs
//             'posts.id', // Add all relevant columns from posts
//             'action_logs.actionLog_id' // Add the missing column
//         )
//         ->get();

//     dd($postLog->toArray());
//     return view('admin.trend_post.index',compact('postLog'));
// }
