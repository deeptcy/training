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


Route::get('courselist','CourseController@courselist')->name('courselist')->middleware('auth'); 
Route::get('ajaxcourseslist','CourseController@ajaxcourselist')->name('ajaxcourselist')->middleware('auth'); 
Route::post('createcourse','CourseController@courseadd')->name('courseadd')->middleware('auth'); 
Route::post('editcourse','CourseController@editcourse')->name('editcourse')->middleware('auth'); 
Route::post('deletecourse','CourseController@deletecourse')->name('deletecourse')->middleware('auth'); 


Route::get('booklist','BookController@booklist')->name('booklist')->middleware('auth'); 
Route::get('ajaxbookslist','BookController@ajaxbooklist')->name('ajaxbooklist')->middleware('auth'); 
Route::post('createbook','BookController@bookadd')->name('bookadd')->middleware('auth'); 
Route::post('editbook','BookController@editbook')->name('editbook')->middleware('auth'); 
Route::post('deletebook','BookController@deletebook')->name('deletebook')->middleware('auth'); 

//Route::get('/', 'ImportController@getImport')->name('import');
Route::post('import_parse', 'QuestionController@parseImport')->name('import_parse');
Route::post('import_process', 'QuestionController@processImport')->name('import_process');






/*

Route::get('questionlist','QuestionController@questionlist')->name('questionlist')->middleware('auth'); 
Route::get('questionlist','QuestionController@questionlist')->name('questionlist')->middleware('auth'); 
*/







Route::post('registeruser', [ 'as' => 'registeruser', 'uses' => 'UserController@registeruser']);
Route::post('loginuserfrm', [ 'as' => 'loginuserfrm', 'uses' => 'UserController@loginuserfrm']);



Route::get('userslist', [ 'as' => 'userslist', 'uses' => 'UserController@index']);
Route::get('ajaxuserslist', [ 'as' => 'ajaxuserslist', 'uses' => 'UserController@ajaxuserslist']);
Route::post('createuser', [ 'as' => 'createuser', 'uses' => 'UserController@createuser']);
Route::post('edituser', [ 'as' => 'edituser', 'uses' => 'UserController@edituser']);
Route::post('deleteuser', [ 'as' => 'deleteuser', 'uses' => 'UserController@deleteuser']);
