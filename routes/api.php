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

//services
Route::get('dailyServices', 'API\ServicesController@dailyServices');
Route::get('fetchServices', 'API\ServicesController@fetchServices');
Route::get('getService/{id}', 'API\ServicesController@getServiceById');

//user
Route::get('getUser/{id}/{status}','API\UserManagementController@getUserId');
Route::get('loginDetail','API\UserManagementController@username');


//transaction
Route::get('transactions/{type}/{id}', 'API\TransactionController@show');
Route::get('transaction/number/{number}', 'API\TransactionController@transaction_number');
Route::get('fetchBranch','API\TransactionController@fetch_branch');
Route::get('branchstatus/{id}/{status}','API\BranchController@branchStatus');
Route::get('transactionDetails/remove/{id}', 'API\TransactionDetailsController@removeITem');
Route::get('transactionsDetails/type/{type}', 'API\TransactionDetailsController@transactionType');
Route::get('gettingDate/{date}/{type}','API\TransactionDetailsController@gettingdate');
Route::get('dashboardstatus', 'API\TransactionDetailsController@dashboardStatus');
Route::get('sales','API\TransactionDetailsController@Sale');
Route::get('fetchtransaction/receipt/{id}', 'API\TransactionController@showReceipt');
Route::get('alltransaction/{id}', 'API\TransactionController@getTransactions');
Route::post('transactions/create/savetransaction', 'API\TransactionController@saveTransaction');


Route::post('/logout', 'Auth\LoginController@logout');
Route::post('/search', 'API\ServicesController@search');

//trashFile
Route::get('trashuser','API\UserManagementController@trashUser');
Route::get('trashbranch','API\BranchController@trashBranch');
Route::get('trashservices','API\ServicesController@trashServices');
Route::get('trashcustomer','API\CustomerController@trashCustomer');


//restore
Route::post('restorefile','API\ServicesController@restoreFile');

//search
Route::post('searchfile','API\ServicesController@searchFile');



