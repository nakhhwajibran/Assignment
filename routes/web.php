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
    return view('auth.login');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    // lots of routes that require auth middleware


    /////////////////////////////////--DISPATCH ROUTES------////////////////////////


    Route::get('/dispatch', 'DispatchController@get')->name('dispatch');
    Route::post('/dispatch', 'DispatchController@add')->name('dispatch.add');
    Route::get('/addDispatch', 'DispatchController@index')->name('dispatch.add.page');
    Route::get('dispatch/edit/{id}', 'DispatchController@edit')->name('dispatch.update.page');
    Route::post('dispatch/save/{id}', 'DispatchController@save')->name('dispatch.update');

    Route::get('dispatch/delete/{id}', 'DispatchController@delete')->name('dispatch.delete');

    Route::get('/exportCsv', 'DispatchController@exportCsv')->name('exportCsv');

    Route::get('/dispatch-grid', 'DispatchController@getGrid')->name('grid');

    Route::post('/loadMore', 'DispatchController@loadMore')->name('loadMore');

    /////////////////////////////////--SOURCE ROUTES------////////////////////////

    Route::get('/source', 'SourceController@get')->name('source');

    Route::post('/source', 'SourceController@add')->name('source.add');
    Route::get('/addSource', 'SourceController@index')->name('source.add.page');

    Route::get('source/edit/{id}', 'SourceController@edit')->name('source.update.page');
    Route::post('source/save/{id}', 'SourceController@save')->name('source.update');

    Route::get('source/delete/{id}', 'SourceController@delete')->name('source.delete');

    /////////////////////////////////--DESTINATION ROUTES------////////////////////////

    Route::get('/destination', 'DestinationController@get')->name('destination');
    Route::get('/addDestination', 'DestinationController@index')->name('destination.add.page');

    Route::get('destination/edit/{id}', 'DestinationController@edit')->name('destination.update.page');
    Route::post('destination/save/{id}', 'DestinationController@save')->name('destination.update');

    Route::get('destination/delete/{id}', 'DestinationController@delete')->name('destination.delete');


    Route::post('/destination', 'DestinationController@add')->name('destination.add');

    /////////////////////////////////--TRANSPORTER ROUTES------////////////////////////


    Route::get('/transporter', 'TransporterController@get')->name('transporter');

    Route::post('/transporter', 'TransporterController@add')->name('transporter.add');
    Route::get('/addTransporter', 'TransporterController@index')->name('transporter.add.page');

    Route::get('transporter/edit/{id}', 'TransporterController@edit')->name('transporter.update.page');
    Route::post('transporter/save/{id}', 'TransporterController@save')->name('transporter.update');

    Route::get('transporter/delete/{id}', 'TransporterController@delete')->name('transporter.delete');


    /////////////////////////////////--DRIVER ROUTES------////////////////////////

    Route::get('/driver', 'DriverController@get')->name('driver');

    Route::post('/driver', 'DriverController@add')->name('driver.add');
    Route::get('/addDriver', 'DriverController@index')->name('driver.add.page');

    Route::get('driver/edit/{id}', 'DriverController@edit')->name('driver.update.page');
    Route::post('driver/save/{id}', 'DriverController@save')->name('driver.update');

    Route::get('driver/delete/{id}', 'DriverController@delete')->name('driver.delete');

    /////////////////////////////////--VEHICLE ROUTES------////////////////////////

    Route::get('/vehicle', 'VehicleController@get')->name('vehicle');

    Route::post('/vehicle', 'VehicleController@add')->name('vehicle.add');
    Route::get('/addVehicle', 'VehicleController@index')->name('vehicle.add.page');

    Route::get('vehicle/edit/{id}', 'VehicleController@edit')->name('vehicle.update.page');
    Route::post('vehicle/save/{id}', 'VehicleController@save')->name('vehicle.update');

    Route::get('vehicle/delete/{id}', 'VehicleController@delete')->name('vehicle.delete');
});
