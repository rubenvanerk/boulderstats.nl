<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Livewire\Dashboard::class);

require __DIR__.'/auth.php';
