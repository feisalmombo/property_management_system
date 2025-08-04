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

//Route for Login view
Route::get('/', function () {
    if (\Auth::user()) {
        return redirect()->back();
    }
    return view('auth.login');
});

//Login Route Controller
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

//Logout Route Controller
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Route for New view/blade user change password
Route::get('/change_password', function () {
    return view('auth.passwords.new_user_change_pwd');
});

//ChangePassword Route Controller
Route::post('/change_password', 'ChangePasswordController@updateNewuser');


Route::resource('/change-password', 'ChangePasswordController');
Route::post('/change-password', 'ChangePasswordController@update');

//Route for CheckUserStatus Middleware
Route::group(['middleware' => 'CheckUserStatus'], function () {

    //Route for ValidateButtonHistory Middleware
    Route::group(['middleware' => 'ValidateButtonHistory'], function () {

        //Route for Auth Middleware
        Route::group(['middleware' => 'auth'], function () {

            //Home Route Controller
            Route::get('/home', 'HomeController@index')->name('home');

            //ViewUser Route Controller
            Route::resource('/view-users', 'ViewUsersController');
            Route::post('/view-users', 'ViewUsersController@store');
            Route::get('/reset/{id}', 'ViewUsersController@resetpwd');

            Route::post('/view-users/report/pdf/{view_type}', 'ViewUsersController@report');
			Route::post('/view-users/report/excel/{view_type}', 'ViewUsersController@downloadExcel');

            Route::get('/view-users/report/downloadData/{type}', 'ViewUsersController@downloadExcel');

            //  MANAGE PROPERTY CONTROLLER
            Route::resource('/view/properties', 'PropertyController');
            Route::post('/view/properties', 'PropertyController@store');


            // MANAGE TENANT CONTROLLER
            Route::resource('/view/tenants', 'TenantController');
            Route::post('/view/tenants', 'TenantController@store');
            Route::get('/view/overdue', 'TenantController@overdue');
            Route::get('/view/expiresoon', 'TenantController@expiresoon');

            // Manage All Activity Logs within the system
            Route::resource('/view/all/activities', 'ActivityLogsController');
            Route::get('/view/all/activities', 'ActivityLogsController@index');
            Route::post('/view/all/activities', 'ActivityLogsController@store');

            //ROUTES FOR PERMISSIONS
            //Call entrust users view
            Route::get('/settings/manage_users/permissions/entrust_user', 'PermissionsController@entrust_user');
            //Get all permissions for specific user
            Route::get('/settings/manage_users/permissions/entrust', 'PermissionsController@entrust');
            //Entrust user route
            Route::post('/settings/manage_users/permissions/entrust_usr', 'PermissionsController@entrust_user_permissions');
            //Get permission for role
            Route::get('/settings/manage_users/permissions/entrustRole', 'PermissionsController@entrust_roles');
            //Route to entrust permissions to the role
            Route::post('/settings/manage_users/permissions/entrust_role_permissions', 'PermissionsController@entrust_role_permissions');
            //Call roles view
            Route::get('/settings/manage_users/permissions/entrust_role', 'PermissionsController@entrust_role');
            Route::resource('/settings/manage_users/permissions/', 'PermissionsController');

            //ROUTES FOR ROLES
            Route::get('/settings/manage_users/roles/entrust', 'RolesController@get_roles');
            Route::post('/settings/manage_users/roles/entrust', 'RolesController@post_roles');
            Route::get('/settings/manage_users/roles/add', 'RolesController@add');
            Route::resource('/settings/manage_users/roles', 'RolesController');
        });
    });
});
