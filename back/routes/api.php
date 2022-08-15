<?php

use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\ResetPasswordController;

use App\Models\Review;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\CommentsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
Route::get('/comments', [CommentsController::class, "allComments"]);
Route::get('/games', [GameController::class, 'show']);
Route::get('/reviews', [ReviewController::class,'index']);
Route::get('/reviews/{id}',[ReviewController::class,'myReview']);
Route::get('/reviews/{review}/comments', [CommentsController::class, "readComments"]);
Route::get('/reviews/{review}/comments/{comment}', [CommentsController::class, "readOneComment"]);
Route::get('/search', [SearchController::class, 'search']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users/{id}', [UserController::class, 'show'])->name('show_user');
    Route::get('/users', [UserController::class, 'show_all'])->name('show_all_users');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('update_user');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('delete_user');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/reviews',[ReviewController::class,'newReview']);
    Route::put('/reviews/{review}',[ReviewController::class,'update']);
    Route::delete('/reviews/{review}',[ReviewController::class,'destroy']);    
    Route::post('/reviews/{review}/comments', [CommentsController::class, "createComments"]);
    Route::put('/reviews/{review}/comments/{comment}', [CommentsController::class, "updateComments"]);
    Route::delete('/reviews/{review}/comments/{comment}', [CommentsController::class, "deleteComments"]);
    Route::post('/games', [GameController::class, "store"]);
    Route::delete('/games/{game}', [GameController::class, "destroy"]); 
});

