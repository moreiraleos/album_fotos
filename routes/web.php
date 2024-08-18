<?php

use App\Http\Controllers\PostControlador;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostControlador::class, 'index']);

Route::post("/", [PostControlador::class, 'store']);

Route::delete("/{id}", [PostControlador::class, 'destroy'])->name("delete");

Route::get("/download/{id}", [PostControlador::class, 'download']);