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

Route::get('/', [
    'as' => 'index',
    'uses' => 'PagesController@index',
    'middleware' => 'guest'
]);

Auth::routes();

Route::get('/login', function() {
    return redirect('/');
});
Route::get('/register', function() {
    return redirect('/');
});


Route::get('/daily_alarm','APIController@sendAlarm');
Route::get('/daily_data', 'APIController@getDailyData');
Route::get('/monthly_data', 'APIController@getMonthlyData');


Route::group(['middleware' => 'auth'], function () {


    Route::get('/dashboard', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@dashboard'
    ]);

    Route::get('/account', 'DashboardController@account');
    Route::get('/password-reset', 'DashboardController@reset');
    Route::get('/topup', 'DashboardController@topup');
    // Route::get('/paymentHistory', 'DashboardController@history');
    Route::get('/energy', 'DashboardController@energy');
    Route::post('/info/edit', 'AlarmsController@update');



    Route::get('/paymentHistoryFilter', 'PaymentsHistoryController@filter');
    Route::post('/paymentHistoryFilter', 'PaymentsHistoryController@filter');
    Route::get('/paymentHistory', 'PaymentsHistoryController@index');
    // Route::resource('paymentshistory', 'PaymentsHistoryController');

    Route::post('pay', 'PaymentsController@standardPay')->name('pay');
    Route::get('/topup/callback', 'PaymentsController@callBack');

    // Route::resource('customers', 'Admin\CustomerController');
    Route::get('/customers', 'Admin\CustomerController@index');
    Route::get('/customers/create',  [
            'uses' => 'Admin\CustomerController@create',
            'as' => 'customers.create'
        ]
    );
    Route::post('/customers/create', 'Admin\CustomerController@store');
    Route::get('/customers/{id}/edit', 'Admin\CustomerController@edit');
    Route::post('/customers/edit', 'Admin\CustomerController@update');
    Route::get('/customers/{id}/topup', 'Admin\CustomerController@topup_form');
    Route::post('/customers/topup', 'Admin\CustomerController@topup');
    Route::get('/deleteCustomer/{id}', 'Admin\CustomerController@destroy');
    Route::any('customerapidetails/{id}', 'Admin\CustomerController@customerAPIDetails');
    Route::any('/customerapidetailsaction', 'Admin\CustomerController@customerAPIDetailsAction');

    Route::resource('daily_readings', 'Admin\ReadingController');
    Route::any('monthly_readings', 'Admin\ReadingController@monthlyReadings');

    Route::resource('alarms', 'AlarmsController');
    Route::resource('payment_history', 'Admin\PaymentHistoryController');
    Route::resource('payment_transactions', 'Admin\PaymentTransactionController');

});


