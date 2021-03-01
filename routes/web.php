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
    return redirect('/login');
});
// Route::get('/', 'MonitoringController');


// DASHBOARD
Route::get('/dashboard', 'DashboardController');

// TRENDING REPORT
Route::get('/trending/report', 'TrendingReportController@index');

// ALARM
Route::prefix('alarm')->group(function () {
    Route::get('/alarm-list', 'AlarmController@alarmList');
    Route::get('/alarm-setting', 'AlarmController@alarmSetting');
});

// API
Route::get('/api/logs', 'ApiController@logs');
Route::get('/api/connection-logs', 'ConnectionController@logs');

// SETTING
Route::prefix('settings')->group(function () {

    //== All Setting
    Route::get('/', 'SettingController@index');

    //== Asset
    Route::get('/asset', 'AssetController@index');
    Route::get('/asset/create', 'AssetController@create');
    Route::get('/asset/{id}/edit', 'AssetController@edit');
    Route::post('/asset/store', 'AssetController@store')->name('asset.store');
    Route::put('/asset/{id}', 'AssetController@update')->name('asset.update');
    Route::get('/asset/detail/{id}', 'AssetController@show')->name('asset.show');
    Route::delete('/asset/{id}', 'AssetController@destroy')->name('asset.delete');
    Route::get('/asset/gettree', 'AssetController@getTree')->name('asset.gettree');


    //== Category Asset
    Route::get('/asset/category', 'CategoryAssetController@index');
    Route::get('/asset/category/create', 'CategoryAssetController@create');
    Route::get('/asset/category/{id}/edit', 'CategoryAssetController@edit');
    Route::post('/asset/category/store', 'CategoryAssetController@store')->name('category.store');
    Route::put('/asset/category/{id}', 'CategoryAssetController@update')->name('category.update');
    Route::delete('/asset/category/{id}', 'CategoryAssetController@destroy')->name('category.delete');

    //== Type Asset
    Route::get('/asset/type', 'TypeAssetController@index');
    Route::get('/asset/type/create', 'TypeAssetController@create');
    Route::get('/asset/type/{id}/edit', 'TypeAssetController@edit');
    Route::post('/asset/type/store', 'TypeAssetController@store')->name('type.store');
    Route::put('/asset/type/{id}', 'TypeAssetController@update')->name('type.update');
    Route::delete('/asset/type/{id}', 'TypeAssetController@destroy')->name('type.delete');

    //== Location Asset

    Route::get('/asset/location', 'LocationAssetController@index');
    Route::get('/asset/location/create', 'LocationAssetController@create');
    Route::get('/asset/location/{id}/edit', 'LocationAssetController@edit');
    Route::post('/asset/location/store', 'LocationAssetController@store')->name('location.store');
    Route::put('/asset/location/{id}', 'LocationAssetController@update')->name('location.update');
    Route::get('/asset/location/detail/{id}', 'LocationAssetController@show')->name('location.show');
    Route::delete('/asset/location/{id}', 'LocationAssetController@destroy')->name('location.delete');

    //== Boms
    Route::get('/asset/bom', 'BomController@index');
    Route::get('/asset/bom/create', 'BomController@create');
    Route::get('/asset/bom/{id}/edit', 'BomController@edit');
    Route::post('/asset/bom/store', 'BomController@store')->name('bom.store');
    Route::put('/asset/bom/{id}', 'BomController@update')->name('bom.update');
    Route::get('/asset/bom/detail/{id}', 'BomController@show')->name('bom.show');
    Route::delete('/asset/bom/{id}', 'BomController@destroy')->name('bom.delete');

     //== Material
     Route::get('/asset/material', 'MaterialController@index');
     Route::get('/asset/material/create', 'MaterialController@create');
     Route::get('/asset/material/{id}/edit', 'MaterialController@edit');
     Route::post('/asset/material/store', 'MaterialController@store')->name('material.store');
     Route::put('/asset/material/{id}', 'MaterialController@update')->name('material.update');
     Route::delete('/asset/material/{id}', 'MaterialController@destroy')->name('material.delete');

    //== Device
    Route::get('/device', 'DeviceController@index');
    Route::get('/device/{id}', 'DeviceController@detail');

    //== Sensor
    Route::get('/sensor', 'SensorController@index');


    //== SOCKET
    Route::get('/socket', 'GlobalSettingController@socket');
    Route::post('/socket/{id?}', 'GlobalSettingController@updateSocket');


    //== DB
    Route::get('/database', 'GlobalSettingController@database');
    Route::post('/database/backup', 'BackupController@backup');
    Route::post('/database/{id?}', 'GlobalSettingController@updateDatabase');


    //== API
    Route::get('/api-config', 'ApiSettingController@apiConfig');
    Route::post('/api-config/{id?}', 'ApiSettingController@updateApi');

    //== Other
    Route::get('/other', 'GlobalSettingController@other');
    Route::post('/other/{id?}', 'GlobalSettingController@updateOther');

    //== Maintenance
    Route::get('/privilege', 'PrivilegeController@index');
    Route::get('/privilege/create', 'PrivilegeController@create');
    Route::get('/privilege/{id}/edit', 'PrivilegeController@edit');
    Route::post('/privilege/store', 'PrivilegeController@store')->name('privilege.store');
    Route::put('/privilege/{id}', 'PrivilegeController@update')->name('privilege.update');
    Route::delete('/privilege/{id}', 'PrivilegeController@destroy')->name('privilege.delete');

    //== Maintenance
    Route::get('/maintenance', 'MaintenanceController@index');
    Route::get('/maintenance/create', 'MaintenanceController@create');
    Route::get('/maintenance/{id}/edit', 'MaintenanceController@edit');
    Route::post('/maintenance/store', 'MaintenanceController@store')->name('maintenance.store');
    Route::put('/maintenance/{id}', 'MaintenanceController@update')->name('maintenance.update');
    Route::delete('/maintenance/{id}', 'MaintenanceController@destroy')->name('maintenance.delete');

    //== Maintenance
    Route::get('/goiot', 'GoiotController@index');
    Route::get('/goiot/create', 'GoiotController@create');
    Route::get('/goiot/{id}/edit', 'GoiotController@edit');
    Route::post('/goiot', 'GoiotController@store')->name('goiot.store');
    Route::put('/goiot/{id}', 'GoiotController@update')->name('goiot.update');
    Route::delete('/goiot/{id}', 'GoiotController@destroy')->name('goiot.delete');
});

// Route::post('/api/sensors', 'SensorController@active');



Auth::routes();



// --USER RESOURCE
Route::resource('/users', 'UserController');

// --DEPARTEMENT RESOURCE
Route::resource('/departements', 'DepartementController');
