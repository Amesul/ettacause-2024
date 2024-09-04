<?php

use App\Http\Controllers\Dashboard\EventController;
use App\Http\Controllers\Dashboard\FetchImageController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\StreamerController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\MilestonesController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect(route('login')));

Route::get('/goals', [MilestonesController::class, 'create'])->name('goals.create');
Route::put('/goals/generate', [MilestonesController::class, 'store'])->name('goals.store');

Route::prefix('assets')->name('assets.')->group(function () {
    Route::patch('/display/streamers', [DisplayController::class, 'streamersUpdate'])->name('streamers.update');
    Route::patch('/display/event', [DisplayController::class, 'eventUpdate'])->name('events.update');
    Route::get('/display', [DisplayController::class, 'index'])->name('display');

    Route::get('/background', fn() => view('assets.background'))->name('background');
    Route::get('/bandeau', fn() => view('assets.bandeau', ['cagnotte_perso' => $_REQUEST['cagnotte_perso']]))->name('bandeau');
    Route::get('/cadre', fn() => view('assets.cadre'))->name('cadre');
    Route::get('/chatbox', fn() => view('assets.chatbox'))->name('chatbox');

    Route::get('/just-chatting', fn() => view('assets.just-chatting'))->name('just-chatting');
    Route::get('/react', fn() => view('assets.react', ['chatbox' => $_REQUEST['chatbox']]))->name('react');
    Route::get('/waiting', fn() => view('assets.waiting', ['selector' => $_REQUEST['selector']]))->name('waiting');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => redirect(route('profile.edit')))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/streamers', [StreamerController::class, 'index'])->name('streamers.index');
    Route::get('/fetchimage', [FetchImageController::class, 'fetchImage']);
    Route::post('/streamers', [StreamerController::class, 'store'])->name('streamers.store');
    Route::delete('/streamers/{streamer:login}', [StreamerController::class, 'destroy'])->name('streamers.destroy');

    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/events', [EventController::class, 'store'])->name('event.store');
    Route::get('/events/{event:slug}', [EventController::class, 'edit'])->name('event.edit');
    Route::patch('/events/{event:slug}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/events/{event:slug}', [EventController::class, 'destroy'])->name('event.destroy');
});

require __DIR__ . '/auth.php';
