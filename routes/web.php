<?php

use App\Http\Controllers\Dashboard\AdminEventController;
use App\Http\Controllers\Dashboard\AdminProfileController;
use App\Http\Controllers\Dashboard\AdminStreamerController;
use App\Http\Controllers\Dashboard\FetchImageController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\MilestonesController;
use App\Http\Controllers\StreamerController;
use App\Models\Streamer;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect(route('login')));


Route::prefix('streamers')->name('streamers.')->group(function () {
    Route::controller(StreamerController::class)->group(function () {
        Route::get('/register', 'create')->name('register');
        Route::get('/register/response', 'store')->name('twitch-response');
    });

    Route::get('/goals', [MilestonesController::class, 'create'])->name('goals.create');
    Route::put('/goals/generate', [MilestonesController::class, 'generate'])->name('goals.generate');
    Route::get('/goals/show', [MilestonesController::class, 'show'])->name('goals.show');

    Route::get('/list', fn() => view('streamer.list', ['streamers' => Streamer::orderBy('login')->get()]))->name('list');
});

Route::prefix('assets')->name('assets.')->group(function () {
    Route::patch('/display/streamers', [DisplayController::class, 'streamersUpdate'])->name('streamers.update');
    Route::patch('/display/event', [DisplayController::class, 'eventUpdate'])->name('events.update');
    Route::get('/display', [DisplayController::class, 'index'])->name('display');

    Route::get('/background', fn() => view('assets.background'))->name('background');

    Route::get('/bandeau', fn() => view('assets.bandeau', ['cagnotte_perso' => $_REQUEST['cagnotte_perso'] ?? false,]))->name('bandeau');
    Route::get('/bandeau-full', fn() => view('assets.bandeau-full', ['cagnotte_perso' => $_REQUEST['cagnotte_perso'] ?? true]))->name('bandeau-full');

    Route::get('/cadre', fn() => view('assets.cadre', ['color' => $_REQUEST['color'] ?? 'turquoise']))->name('cadre');

    Route::get('/chatbox', fn() => view('assets.chatbox', ['channel' => $_REQUEST['channel'] ?? '', 'background' => $_REQUEST['background'] ?? false]))->name('chatbox');

    Route::get('/waiting', fn() => view('assets.waiting', ['selector' => $_REQUEST['selector'] ?? 'intro']))->name('waiting');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => redirect(route('profile.edit')))->name('dashboard');

    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/streamers', [AdminStreamerController::class, 'index'])->name('streamers.index');
    Route::get('/fetchimage', [FetchImageController::class, 'fetchImage']);
    Route::post('/streamers', [AdminStreamerController::class, 'store'])->name('streamers.store');
    Route::delete('/streamers/{streamer:login}', [AdminStreamerController::class, 'destroy'])->name('streamers.destroy');

    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('event.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('event.store');
    Route::get('/events/{event:slug}', [AdminEventController::class, 'edit'])->name('event.edit');
    Route::patch('/events/{event:slug}', [AdminEventController::class, 'update'])->name('event.update');
    Route::delete('/events/{event:slug}', [AdminEventController::class, 'destroy'])->name('event.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
