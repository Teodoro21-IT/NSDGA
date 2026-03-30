<?php
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::view('/imported-home', 'UserHomepage.nsdga_homepage');
    Route::view('/kindergarten', 'UserHomepage.kindergarten');
    Route::view('/elementary-online', 'UserHomepage.elemOnline');
    Route::view('/elementary-oncampus', 'UserHomepage.elemOnCampus');
    Route::view('/jhs-online', 'UserHomepage.jhsOnline');
    Route::view('/jhs-oncampus', 'UserHomepage.jhsOnCampus');
    Route::view('/shs-online', 'UserHomepage.shsOnline');
    Route::view('/shs-oncampus', 'UserHomepage.shsOnCampus');
    Route::view('/about', 'UserHomepage.about');
    Route::view('/school-calendar', 'UserHomepage.schoolcalendar');
});
