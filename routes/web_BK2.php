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
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');


Route::resource('pages', 'PageController')->middleware('auth'); 



Route::get('questionlist','QuestionController@questionlist')->name('questionlist')->middleware('auth'); 
Route::get('ajaxquestionslist','QuestionController@ajaxquestionlist')->name('ajaxquestionlist')->middleware('auth'); 
Route::post('createquestion','QuestionController@questionadd')->name('questionadd')->middleware('auth'); 
Route::post('editquestion','QuestionController@editquestion')->name('editquestion')->middleware('auth'); 
Route::post('deletequestion','QuestionController@deletequestion')->name('deletequestion')->middleware('auth'); 





//Route::get('/', 'ImportController@getImport')->name('import');
Route::post('import_parse', 'QuestionController@parseImport')->name('import_parse');
Route::post('import_process', 'QuestionController@processImport')->name('import_process');






/*

Route::get('questionlist','QuestionController@questionlist')->name('questionlist')->middleware('auth'); 
Route::get('questionlist','QuestionController@questionlist')->name('questionlist')->middleware('auth'); 
*/









Route::get('admin/users', [ 'as' => 'admin/users', 'uses' => 'UserController@index']);
Route::get('admin/ajaxuserslist', [ 'as' => 'admin/ajaxuserslist', 'uses' => 'UserController@ajaxuserslist']);
Route::post('admin/createuser', [ 'as' => 'admin/createuser', 'uses' => 'UserController@createuser']);
Route::post('admin/edituser', [ 'as' => 'admin/edituser', 'uses' => 'UserController@edituser']);
Route::post('admin/deleteuser', [ 'as' => 'admin/deleteuser', 'uses' => 'UserController@deleteuser']);
