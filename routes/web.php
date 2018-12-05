<?php

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
Route::get('/', 'HomeController@index')->name('homes.index');
Route::get('/resumes', 'ResumeController@index')->name('resumes.index');
Route::get('/resumes/inquire', 'ResumeController@inquery')->name('resumes.inquery');