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

// Default authentication routes
Auth::routes(['register' => false]);

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('dashboard', 'DashboardController')->middleware('can:dashboard');
	Route::get('dashboard/detail/{title}', 'DashboardDetailController@index')->middleware('can:dashboard');
	Route::resource('notifications', 'NotificationsController')->middleware('can:notifications');
	Route::resource('communities', 'CommunityController')->middleware('can:communities');
	Route::resource('people', 'PersonController')->middleware('can:people');
	Route::resource('groups', 'GroupController')->middleware('can:groups');
	Route::resource('features', 'FeatureController')->middleware('can:features');
	Route::resource('profiles', 'ProfileController')->middleware('can:profiles');
	Route::resource('meetings', 'MeetingController')->middleware('can:meetings');
	Route::resource('meetingReports', 'MeetingReportController')->middleware('can:meeting_reports');
	Route::resource('assistants', 'AssistantController')->middleware('can:assistants');
	Route::resource('account', 'AccountController')->middleware('can:account');
	Route::resource('associatedUsers', 'AssociatedUsersController')->middleware('can:associated_users');
	Route::resource('guests', 'GuestController')
		->only(['create', 'store'])
		->middleware('can:guests');
	Route::resource('communityPeople', 'CommunityPeopleController')
		->only(['create', 'store', 'destroy'])
		->middleware('can:people');

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


