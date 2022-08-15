<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Review;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function search(Request $request){
        $query = $request->input('query');
        $gameId = $request->input('gameId');
        $order = $request->input('order');

        $project = Review::query();

        if ($query != "") {
            $project->where(function(Builder $builder) use ($query) {
                $builder->where('title', 'like', '%' . $query . '%')
                        ->orWhere('content', 'like', '%' . $query . '%')
                        ->orWhereHas('game', function (Builder $game) use ($query) {
                            $game->where('name', 'like', '%' . $query . '%');
                        });
            });
        }
        if ($gameId != "") {
            $project->whereHas('game', function (Builder $game) use ($gameId) {
                $game->where('game_id', $gameId);
            });
        }
        if ($order != "") {
            switch ($order) {
                case "date_asc": $project->orderBy('created_at', 'ASC'); break;
                case "date_desc": $project->orderBy('created_at', 'DESC'); break;
                case "comments_desc": $project->withCount('comments')->orderBy('comments_count', 'DESC'); break;
                case "comments_asc": $project->withCount('comments')->orderBy('comments_count', 'ASC'); break;
                case "rank_desc": $project->orderBy('review_rank', 'DESC'); break;
                case "rank_asc": $project->orderBy('review_rank', 'ASC'); break;
                default: break;
            }
        }
        return $project->get();
    }
}
