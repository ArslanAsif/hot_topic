<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Topic;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $comments = [];

        $topic = Topic::orderBy('created_at', 'desc')->first();
        if($topic)
        {
            $comments = $topic->comments()->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('admin.dashboard')->with(['topic' => $topic, 'comments' => $comments]);
    }
    
    public function getAllUsers()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('admin.users')->with('users', $users);
    }
    
    public function getAllTopics()
    {
        $topics = Topic::orderBy('created_at', 'desc')->get();
        return view('admin.previous_topics')->with('topics', $topics);
    }

    public function getTopic($id)
    {
        $topic = Topic::where('id', $id)->first();
        $comments = $topic->comments()->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.dashboard')->with(['topic' => $topic, 'comments' => $comments]);
    }
    
    public function getAddTopic()
    {
        return view('admin.new_topic');
    }

    public function postAddTopic(Request $request)
    {
        $topic = new Topic();
        $topic->title = $request['title'];
        
        $topic->save();


        return redirect()->back()->with('message', 'New topic has been added');
    }

    public function getEditTopic()
    {
        $topic = Topic::orderBy('created_at','desc')->first();
        return view('admin.new_topic')->with('topic', $topic);
    }
    
    public function postEditTopic(Request $request)
    {
        $topic = Topic::orderBy('created_at','desc')->first();

        $topic->title = $request['title'];
        $topic->update();

        return redirect()->back()->with('message', 'Topic Edited');
    }
    
    public function getBanUser($id)
    {
        $user = User::where('id', $id)->first();
        if($user->ban == 1)
        {
            $user->ban = 0;
        }
        else
        {
            $user->ban = 1;
        }
        
        $user->update();
        
        return redirect()->back()->with('message', 'Successful');
    }
}
