<?php

use Illuminate\Support\Facades\Auth;
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

Route::view('issues', 'issues.index');

Route::post('issues/store', 'IssuesController@store');
Route::get('test', 'IssuesController@test');

//

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::view('services', 'services');

Route::get('costom/login', 'CostomAuthController@login');

Route::get('costom/login/{id}', 'CostomAuthController@Costomlogin');

Route::get('issues/list', 'IssuesController@list');

Route::post('issues/import', 'IssuesController@importFromExcel');

Route::view('issue-form', 'excel-import');

Route::get('users','UsersController@export');
