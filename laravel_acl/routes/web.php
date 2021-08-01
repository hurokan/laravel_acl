<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/change-password', 'HomeController@changePassword')->name('change-password');
    Route::post('/change-password', 'HomeController@storeChangePassword')->name('store-change-password');

    Route::prefix('users')->group(function () {
        Route::get('/', 'Acl\UserController@index')->name('user.index');  //List of users
        Route::get('/create', 'Acl\UserController@create')->name('user.create-new-user'); //create form
        Route::post('/', 'Acl\UserController@store')->name('user.store-new-user'); //post form data
        Route::get('/{id}', 'Acl\UserController@show')->name('user.show-existing-user'); //specific user view
        Route::get('/edit/{id}', 'Acl\UserController@edit')->name('user.edit-existing-user'); //edit form
        Route::put('/{id}', 'Acl\UserController@update')->name('user.update-existing-user'); //edit form submit with put
        Route::delete('/{id}', 'Acl\UserController@destroy')->name('user.destroy-existing-user'); //Delete specific users
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', 'Acl\RoleController@index')->name('role.index');
        Route::get('/create', 'Acl\RoleController@create')->name('role.create-new-role');
        Route::post('/', 'Acl\RoleController@store')->name('role.store_new_role');
        Route::get('/{id}', 'Acl\RoleController@show')->name('role.show-existing-role');
        Route::get('/edit/{id}', 'Acl\RoleController@edit')->name('role.edit-existing-role');
        Route::put('/{id}', 'Acl\RoleController@update')->name('role.update-existing-role');
        Route::delete('/{id}', 'Acl\RoleController@destroy')->name('role.destroy-existing-role');
    });

    Route::prefix('menus')->group(function () {
        Route::get('/', 'Acl\MenuController@index')->name('menu.index');
        Route::get('/create', 'Acl\MenuController@create')->name('menu.create-new-menu');
        Route::post('/', 'Acl\MenuController@store')->name('menu.menu-new-menu');
        Route::get('/{id}', 'Acl\MenuController@show')->name('menu.show-existing-menu');
        Route::get('/edit/{id}', 'Acl\MenuController@edit')->name('menu.edit-existing-menu');
        Route::put('/{id}', 'Acl\MenuController@update')->name('menu.update-existing-menu');
        Route::delete('/{id}', 'Acl\MenuController@destroy')->name('menu.destroy-existing-menu');
    });

    Route::prefix('permission')->group(function () {
        Route::get('/', 'Acl\PermissionController@index')->name('permission.index');
        Route::get('/create', 'Acl\PermissionController@create')->name('permission.create-new-permission');
        Route::post('/', 'Acl\PermissionController@store')->name('permission.store-new-permission');
        Route::get('/{id}', 'Acl\PermissionController@show')->name('permission.show-existing-permission');
        Route::get('/edit/{id}', 'Acl\PermissionController@edit')->name('permission.edit-existing-permission');
        Route::put('/{id}', 'Acl\PermissionController@update')->name('permission.update-existing-permission');
        Route::delete('/{id}', 'Acl\PermissionController@destroy')->name('permission.destroy-existing-permission');
    });

    Route::prefix('credentials')->group(function () {
        Route::get('/menu/{id}', 'Acl\CredentialController@getMenuByRole')->name('credential.get-menu');
        Route::post('/menu/{id}', 'Acl\CredentialController@storeMenu')->name('credential.store-menu');
        Route::get('/permission/{id}', 'Acl\CredentialController@getPermissionByRole')->name('credential.get-permission');
        Route::post('/permission/{id}', 'Acl\CredentialController@storePermission')->name('credential.store-permission');
    });

});
