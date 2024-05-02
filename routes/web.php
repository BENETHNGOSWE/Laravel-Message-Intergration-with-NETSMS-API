<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-message-form', [MessageController::class, 'showSendMessageForm'])->name('message');
Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('sendmessage');
