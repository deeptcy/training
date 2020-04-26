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


Route::post('registeruser', [ 'as' => 'registeruser', 'uses' => 'UserController@registeruser']);
Route::post('loginuserfrm', [ 'as' => 'loginuserfrm', 'uses' => 'UserController@loginuserfrm']);

Route::get('dashboard','DashboardController@dashboard')->name('dashboard')->middleware('auth'); 

Route::get('userslist', [ 'as' => 'userslist', 'uses' => 'UserController@index']);
Route::get('ajaxuserslist', [ 'as' => 'ajaxuserslist', 'uses' => 'UserController@ajaxuserslist']);
Route::post('createuser', [ 'as' => 'createuser', 'uses' => 'UserController@createuser']);
Route::post('edituser', [ 'as' => 'edituser', 'uses' => 'UserController@edituser']);
Route::post('deleteuser', [ 'as' => 'deleteuser', 'uses' => 'UserController@deleteuser']);


Route::get('myprofile', [ 'as' => 'myprofile', 'uses' => 'ProfileController@myprofile']);
Route::post('updateprofile', [ 'as' => 'updateprofile', 'uses' => 'ProfileController@updateprofile']);


Route::get('myuserslist', [ 'as' => 'myuserslist', 'uses' => 'MyUserController@index']);
Route::get('ajaxmyuserslist', [ 'as' => 'ajaxmyuserslist', 'uses' => 'MyUserController@ajaxmyuserslist']);
Route::post('createmyuser', [ 'as' => 'createmyuser', 'uses' => 'MyUserController@createmyuser']);
Route::post('editmyuser', [ 'as' => 'editmyuser', 'uses' => 'MyUserController@editmyuser']);
Route::post('deletemyuser', [ 'as' => 'deletemyuser', 'uses' => 'MyUserController@deletemyuser']);


Route::get('companylist', [ 'as' => 'companylist', 'uses' => 'CompanyController@index']);
Route::get('ajaxcompanylist', [ 'as' => 'ajaxcompanylist', 'uses' => 'CompanyController@ajaxcompanylist']);
Route::post('createcompany', [ 'as' => 'createcompany', 'uses' => 'CompanyController@createcompany']);
Route::post('editcompany', [ 'as' => 'editcompany', 'uses' => 'CompanyController@editcompany']);
Route::post('deletecompany', [ 'as' => 'deletecompany', 'uses' => 'CompanyController@deletecompany']);


Route::get('trainerlist', [ 'as' => 'trainerlist', 'uses' => 'TrainerController@index']);
Route::get('ajaxtrainerlist', [ 'as' => 'ajaxtrainerlist', 'uses' => 'TrainerController@ajaxtrainerlist']);
Route::post('createtrainer', [ 'as' => 'createtrainer', 'uses' => 'TrainerController@createtrainer']);
Route::post('edittrainer', [ 'as' => 'edittrainer', 'uses' => 'TrainerController@edittrainer']);
Route::post('deletetrainer', [ 'as' => 'deletetrainer', 'uses' => 'TrainerController@deletetrainer']);


Route::get('courselist','CourseController@courselist')->name('courselist')->middleware('auth'); 
Route::get('ajaxcourseslist','CourseController@ajaxcourselist')->name('ajaxcourselist')->middleware('auth'); 
Route::post('createcourse','CourseController@courseadd')->name('courseadd')->middleware('auth'); 
Route::post('editcourse','CourseController@editcourse')->name('editcourse')->middleware('auth'); 
Route::post('deletecourse','CourseController@deletecourse')->name('deletecourse')->middleware('auth'); 


Route::get('mycourselist','MyCourseController@mycourselist')->name('mycourselist')->middleware('auth'); 
Route::get('ajaxmycourseslist','MyCourseController@ajaxmycourselist')->name('ajaxmycourselist')->middleware('auth'); 
Route::post('createmycourse','MyCourseController@mycourseadd')->name('mycourseadd')->middleware('auth'); 
Route::post('editmycourse','MyCourseController@editmycourse')->name('editmycourse')->middleware('auth'); 
Route::post('deletemycourse','MyCourseController@deletemycourse')->name('deletemycourse')->middleware('auth'); 


Route::get('booklist','BookController@booklist')->name('booklist')->middleware('auth'); 
Route::get('ajaxbookslist','BookController@ajaxbooklist')->name('ajaxbooklist')->middleware('auth'); 
Route::post('createbook','BookController@bookadd')->name('bookadd')->middleware('auth'); 
Route::post('editbook','BookController@editbook')->name('editbook')->middleware('auth'); 
Route::post('deletebook','BookController@deletebook')->name('deletebook')->middleware('auth'); 


Route::get('questionlist','QuestionController@questionlist')->name('questionlist')->middleware('auth'); 
Route::get('ajaxquestionslist','QuestionController@ajaxquestionlist')->name('ajaxquestionlist')->middleware('auth'); 
Route::post('createquestion','QuestionController@questionadd')->name('questionadd')->middleware('auth'); 
Route::post('editquestion','QuestionController@editquestion')->name('editquestion')->middleware('auth'); 
Route::post('deletequestion','QuestionController@deletequestion')->name('deletequestion')->middleware('auth'); 


//Route::get('/', 'ImportController@getImport')->name('import');
Route::post('import_parse', 'QuestionController@parseImport')->name('import_parse');
Route::post('import_process', 'QuestionController@processImport')->name('import_process');


Route::get('couponlist','CouponController@couponlist')->name('couponlist')->middleware('auth'); 
Route::get('ajaxcouponslist','CouponController@ajaxcouponlist')->name('ajaxcouponlist')->middleware('auth'); 
Route::post('createcoupon','CouponController@couponadd')->name('couponadd')->middleware('auth'); 
Route::post('editcoupon','CouponController@editcoupon')->name('editcoupon')->middleware('auth'); 
Route::post('deletecoupon','CouponController@deletecoupon')->name('deletecoupon')->middleware('auth'); 

