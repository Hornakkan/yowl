<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(){
        return Review::all();
    }

    public function myReview(Review $id){
        return $id;
    }

    public function newReview(Request $request){
        request()->validate([
            'title'=>'required',
            'game_id' => 'required',
            'picture' => 'required',
            'content' => 'required',
            'author_id' => 'required',
            'review_rank' => 'required',
        ]);

        if($request->file('picture') != '') {
            $image = $request->file('picture');
            $image_name = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $imageName = uniqid().'.'.$extension;
            $image->move(public_path('img'), $imageName);
        } else {
            $imageName = '';
        }

        return Review::create([
            'title' => request('title'),
            'game_id' => request('game_id'),
            'picture' => $imageName,
            'content' => request('content'),
            'author_id' => request('author_id'),
            'review_rank' => request('review_rank'),
        ]);
    }

    public function update(Review $review){
        request()->validate([
            'title'=>'required',
            'content' => 'required',
        ]);
    
        $success = $review->update([
            'title'=>request('title'),
            'content' => request('content'),
        ]);
    
        return [
            'success' => $success
        ];
    }

    public function destroy(Review $review){
        $success = $review->delete();
        if ($review->picture) {
            unlink(public_path('img').'/'. $review->picture);
        }

        return[
            'success' => $success
        ];
    }
}
