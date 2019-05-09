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

Route::get('/', 'PagesController@index');

// Admin functions
Route::get('/admin', 'AdminController@login');
Route::post('/admin/login/attempt', 'AdminController@attempt_login');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/logout', 'AdminController@logout');
Route::get('/admin/courses', 'AdminController@view_all_courses');
Route::get('/admin/courses/new', 'AdminController@new_course');
Route::post('/admin/courses/create', 'AdminController@create_course');
Route::get('/admin/courses/edit/{course_id}', 'AdminController@edit_course');
Route::post('/admin/courses/update', 'AdminController@update_course');
Route::get('/admin/courses/{course_id}/modules', 'AdminController@view_course_content');
Route::post('/admin/courses/delete', 'AdminController@delete_course');

// Member functions
Auth::routes();
Route::get('/members/dashboard', 'MembersController@dashboard');
Route::get('/members/logout', 'MembersController@logout');