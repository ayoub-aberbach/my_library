<?php

use App\Livewire\Authors;
use App\Livewire\Books;
use App\Livewire\Dashboard;
use App\Livewire\IssueBooks;
use App\Livewire\Login;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "auth"], function () {
    Route::get('/dashboard', Dashboard::class)->name("dashboard");
    Route::get('/authors', Authors::class)->name("authors");
    Route::get('/books', Books::class)->name("books");
    Route::get('/issue-books', IssueBooks::class)->name("issue-books");
    Route::get('/profile', Profile::class)->name("profile");
});

Route::group(["middleware" => "guest"], function () {
    Route::get('/', Login::class)->name("login");
});

Route::get('/language/{locale}', function (string $locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        return redirect()->back();
    }
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('locale');
