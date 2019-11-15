<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'services' => 'API\ServicesController',
    'customers' => 'API\CustomerController',
    'transactionDetails' => 'API\TransactionDetailsController',
    'UserManagement'=> 'API\UserManagementController',
    'role'=>'API\RoleController',
    'branch' => 'API\BranchController',
    'points' => 'API\CustomerPointsController'
]);

// Route::post('/login', 'AuthController@login')->name('login');
// Route::post('/register', 'AuthController@login')->name('register');


Route::apiResource('transactions', 'API\TransactionController', [
    'except' => ['show']
]);

Route::get('transactions/{type}/{id}', 'API\TransactionController@show');
Route::get('dailyServices', 'API\ServicesController@dailyServices');
Route::get('fetchServices', 'API\ServicesController@fetchServices');
Route::get('getService/{id}', 'API\ServicesController@getServiceById');
Route::get('getUser/{id}/{status}','API\UserManagementController@getUserId');
Route::get('transaction/number/{number}', 'API\TransactionController@transaction_number');
Route::get('fetchBranch','API\TransactionController@fetch_branch');
Route::get('transactionDetails/remove/{id}', 'API\TransactionDetailsController@removeITem');
Route::get('transactionsDetails/type/{type}', 'API\TransactionDetailsController@transactionType');
Route::get('dashboardstatus', 'API\TransactionDetailsController@dashboardStatus');
Route::get('loginDetail','API\UserManagementController@username');

Route::post('transactions/create/savetransaction', 'API\TransactionController@saveTransaction');


Route::post('/logout', 'Auth\LoginController@logout');