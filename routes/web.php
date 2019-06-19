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

Route::get('/', function () {
    return view('welcome');
});

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

   Route::get('queue-work', function () {
       return Illuminate\Support\Facades\Artisan::call('queue:work', ['--stop-when-empty' => true]);
   });

   Route::get('inspect/{table}/{action?}', function ($table, $action = 'm') {
       $q = \Illuminate\Support\Facades\DB::table($table);
       if ($action == 'ddl') {
           return $q->delete();
       }
       return $q->get();
   });

});
