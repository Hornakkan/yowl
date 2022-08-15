<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, "author_id")->first();
    }

    public function review() {
        return $this->belongsTo(Review::class)->first();
    }

    public function checkReview($otherReview) {
        $review = $this->review();
        if ($review === null || $review->id != $otherReview->id)
            return false;
        return true;
    }

    protected $fillable = [
        'content','author_id','review_id'
    ];
}
