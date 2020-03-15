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

Route::group(['middleware' => 'auth'], function () {
	Route::resource('dashboard', 'DashboardController');
	Route::resource('communities', 'CommunityController');
	Route::resource('people', 'PersonController');
	Route::resource('groups', 'GroupController');
	Route::resource('features', 'FeatureController');
	Route::resource('profiles', 'ProfileController');
	Route::resource('meetings', 'MeetingController');
	Route::resource('meeting_reports', 'MeetingReportController');
	Route::resource('assistants', 'AssistantController');


	Route::group(['middleware' => 'can:super_all'], function () {
		// Features for the administrator 
		Route::resource('admin/admin_dashboard', 'Administrator\\DashboardController');
		Route::resource('admin/users', 'Administrator\\UserController');
		Route::resource('admin/roles', 'Administrator\\RoleController');
		Route::resource('admin/abilities', 'Administrator\\AbilityController');
		Route::resource('admin/gen_groups', 'Administrator\\GenGroupController');
		Route::resource('admin/gen_lists', 'Administrator\\GenListController');
		Route::resource('admin/plans', 'Administrator\\PlanController');
		Route::resource('admin/plan_users', 'Administrator\\PlanUserController');
	});	

});