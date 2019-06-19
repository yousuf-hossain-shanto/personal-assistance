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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('expense', 'ExpenseController');
Route::resource('expense-head', 'ExpenseHeadController');
Route::resource('expense-recurring', 'RecurringExpenseController');

Route::group(['prefix' => 'education', 'as' => 'education.'], function () {
    Route::resource('course', 'CourseController');
    Route::resource('course-material', 'CourseMaterialController');
});

Route::group(['prefix' => 'automation', 'as' => 'automation.'], function () {
   Route::get('gmail-imap', 'AutomationController@gmailImap')->name('gmail-imap');
});
