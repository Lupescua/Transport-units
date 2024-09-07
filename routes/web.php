<?php

use App\Http\Controllers\VehiclesController;
use Inertia\Inertia;

Route::get('/', function () {
     $vehicles = (new VehiclesController)->index();
    return Inertia::render('Welcome', ['vehicles' => $vehicles]);
});
Route::get('/vehicles/{type}', [VehiclesController::class, 'sort']);
Route::post('/vehicles', [VehiclesController::class, 'store']);
Route::put('/vehicles/{id}', [VehiclesController::class, 'update']);
Route::delete('/vehicles/delete/{id}', [VehiclesController::class, 'delete']);

require __DIR__.'/auth.php';
