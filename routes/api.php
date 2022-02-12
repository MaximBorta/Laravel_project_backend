<?php

use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\FriendsController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserOfflineController;
use App\Http\Controllers\UserOnlineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'users', 'middleware' => 'CORS'], function ($router) {
// Auth
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/view-profile', [UserController::class, 'viewProfile']);
    Route::get('/logout', [UserController::class, 'logout']);

    Route::post('/upload-avatar', [UserController::class, 'uploadAvatar']);
    Route::put('/edit-profile', [UserController::class, 'editProfile']);
//CRUD Posts
    Route::post('/create-post', [PostController::class, 'store']);
    Route::get('/user-posts', [PostController::class, 'user_posts']);
    Route::get('/user-posts/{id}/show', [PostController::class, 'show_user_post']);
    Route::post('/user-posts/{id}/update', [PostController::class, 'update_user_post']);
    Route::delete('/user-posts/{id}/delete', [PostController::class, 'destroy_post']);
// Chat
    Route::get('/conversation/last', [ConversationController::class, 'last']);
    Route::get('/conversation/last/{user}', [ConversationController::class, 'last']);

    Route::get('/conversation/{user}', [ConversationController::class, 'index']);
    Route::post('/conversation/{user}', [ConversationController::class, 'store']);
    Route::get('/friends', [FriendsController::class, 'index']);
    Route::get('/friends/{friend}', [FriendsController::class, 'get_one']);
// Online Users
// Offline Users
    Route::put('/user/{user}/online', UserOnlineController::class);
    Route::put('/user/{user}/offline', UserOfflineController::class);
//Comments
    Route::get('/get-post-comment/{post_id}', [CommentController::class, 'get_post_comment']);
    Route::post('/send-comment/{post_id}', [CommentController::class, 'create_comment']);
});

Route::group(['prefix' => 'main'], function() {
    Route::get('/home-header', [HomeController::class, 'homeHeader']);
    Route::get('/home-cards', [HomeController::class, 'homeCards']);
    Route::get('/home-cards/{id}', [HomeController::class, 'showHomeCard']);
    Route::put('/home-cards/{id}/update', [HomeController::class, 'updateHomeCard']);
});

