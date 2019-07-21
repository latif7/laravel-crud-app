<?php

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('post-login');

//admin route
Route::group(['middleware' => ['auth','role:admin']], function (){

    Route::resource('users', 'UserController')->only(['index', 'store','edit','update']);

});

//admin and operator access

Route::group(['middleware' => ['auth','role:admin,operator']], function (){
    Route::get('/dashboard', 'ReportController@index')->name('dashboard');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    //details reports route
    Route::get('/report', 'ReportController@reportDetails')->name('report-details');
    Route::get('/report/datatable', 'ReportController@reportDataTable')->name('report-details-datatable');
    Route::post('/report-details/export', 'ReportController@exportReport')->name('report-details-export');

    Route::get('/summery-report', 'ReportController@reportSummery')->name('summery-report');
    Route::get('/summery-report/datatable', 'ReportController@reportSummeryDataTable')->name('summery-report-datatable');
    Route::post('/summery-report/export', 'ReportController@exportSummeryReport')->name('summery-report-export');

    Route::get('/users/change-password', 'UserController@changePassword')->name('users.change-password');
    Route::post('/users/change-password', 'UserController@updatePassword')->name('users.change-password');

    Route::get('/404', "ErrorController@notFound")->name('not-found');
    Route::get('/500', "ErrorController@serverError")->name('server-error');

});



