<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        
        Comment::create($request->all());

        return redirect()->back();
    }
}
