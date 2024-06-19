<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
    Route::get("post", [ApiController::class, "findAllPost"]);
    Route::post("post", [ApiController::class, "addPost"]);
    Route::get("post/{id}", [ApiController::class, "findCommentById"]);
    Route::post("comment", [ApiController::class, "addComment"]);
    Route::post("reply", [ApiController::class, "reply"]);
    Route::get("shop", [ApiController::class, "shop"]);
    Route::put("profile", [ApiController::class, "updateProf"]);
});
