<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function game(){
        return $this->belongsTo(Game::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    protected $fillable = [
        'title',
        'game_id',
        // 'posted_at',
        'picture',
        'content',
        'author_id',
        'review_rank'
    ];

}
