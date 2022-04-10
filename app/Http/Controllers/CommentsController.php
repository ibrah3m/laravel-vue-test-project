<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Replay;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentsController extends Controller
{
    //

    public function create(Request $request)
    {

        return  Comment::create(['name' => $request->name ,'comment_text'=>$request->comment]);
    }
    public function show()
    {
        return response()->json([
            'comments' => Comment::with('comment_replys.comment_replys.comment_replys')->where('parent_id',0)->latest()->get()
        ], Response::HTTP_OK);

    }

    public function addReply(Request $request)
    {

        return  Comment::create(['name' => $request->name ,'comment_text'=>$request->comment,'parent_id'=>$request->comment_id]);

    }
}
