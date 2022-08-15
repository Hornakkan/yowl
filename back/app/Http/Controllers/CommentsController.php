<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function createComments(Request $request, Review $review){
        request()->validate([
            'author_id'=>'required|integer',
            'content'=>'required',
        ]);
        
        return Comment::create([
            'author_id' => request('author_id'),
            'review_id' => $review->id,
            'content' => request('content')
        ]);
    }

    public function readComments(Request $request, Review $review){
        return $review->comments()->get()->map(
            function ($comment){
                $comment['user'] = $comment->user();
                return $comment;
            }
        );
    }
    public function readOneComment(Request $request, Review $review, Comment $comment){
        if ($comment->checkReview($review) == false)
            abort(404);
        return $comment;
    }
    public function updateComments(Request $request, Review $review, Comment $comment){
        request()->validate([
            'author_id'=>'required|integer',
            'content'=>'required',
        ]);
        if ($comment->checkReview($review) == false)
            abort(404);
        $success = $comment->update([
            'author_id' => request('author_id'),
            'content' => request('content')
        ]);
        return [
            'success' => $success
        ];
    }

    public function deleteComments(Request $request, Review $review, Comment $comment){
        if ($comment->checkReview($review) == false)
            abort(404);
        $success = $comment->delete();
        return [
            'success'=> $success
        ];
    }

    public function allComments() {
        $success = Comment::All();
        return [
            'success' => $success
        ];
    }


    
}
