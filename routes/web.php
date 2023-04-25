<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes pour les non connectés
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Routes pour les users connectés
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/activity/{id}', function (int $id) {
        return Inertia::render('Activities/Show', [
            'activity' => App\Models\Activity::select('*', 'activities.name as activityName', 'users.name as userName', 'activities.id as activityID', 'users.id as userID')->join('users', 'activities.user_id', '=', 'users.id')->where('activities.id', $id)->first()
        ]);
    })->name('activities.show');
});
