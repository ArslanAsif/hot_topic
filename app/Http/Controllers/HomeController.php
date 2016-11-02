<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $comments = [];
        $topic = Topic::orderBy('created_at', 'desc')->first();
        if($topic)
        {
            $comments = $topic->comments()->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('index')->with(['topic' => $topic, 'comments' => $comments]);
    }

    public function postComment($id, Request $request)
    {
        $comment = new Comment();
        $comment->comment = $request['comment'];
        $comment->topic_id = $id;

        $message = 'Problem posting comment';
        if($request->user()->comments()->save($comment))
        {
            $message = "Feedback successfully posted!";
        }

        return redirect()->back()->with('message', $message);
    }

    public function getDeleteComment($id)
    {
        $comment = Comment::where('id', $id)->first();
        if(isset($comment))
        {
            if($comment->user()->first()->id == Auth::user()->id || Auth::user()->is_admin)
            {
                $comment->delete();
                return redirect()->back()->with('message', 'Comment Deleted');
            }
        }

        return redirect()->back()->with('message', 'Admin access only');
    }
}
