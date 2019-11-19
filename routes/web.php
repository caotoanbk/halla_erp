<?php

Route::get('/', function(){
    return redirect()->route('home');
});

Route::resource('purchases', 'PurchaseController');
Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){

    Route::get('/', function() {

        session(['selectedFunc' => 'admin']);

        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', 'ManageController@adminHome')->name('admin.dashboard');

});

Route::prefix('material')->group(function(){

    Route::get('/', function() {

        session(['selectedFunc' => 'material']);

        return redirect()->route('material.dashboard');
    });

    Route::get('/dashboard', 'ManageController@materialHome')->name('material.dashboard');

});

Route::prefix('approval')->group(function(){

    Route::get('/', function() {

        session(['selectedFunc' => 'approval']);

        return redirect()->route('approval.dashboard');
    });
    Route::get('/dashboard', 'ManageController@approvalHome')->name('approval.dashboard');

    Route::get('/{approvaltype}/create', 'ApprovalController@create');
    
    Route::get('/{approvaltype}/update/{id}', 'ApprovalController@update');
});

Route::prefix('crud')->group(function(){

    Route::get('/data/{table}', 'CrudController@datatable')->name('crud.data');

    Route::get('/{table}', 'CrudController@index')->name('crud.index');

    Route::get('/{table}/show/{id}', 'CrudController@show')->name('crud.show');

    Route::get('/{table}/create', 'CrudController@create')->name('crud.create');

    Route::post('/{table}/store', 'CrudController@store')->name('crud.store');

    Route::get('/{table}/edit/{id}', 'CrudController@edit')->name('crud.edit');

    Route::patch('/{table}/{id}', 'CrudController@update')->name('crud.update');

    Route::delete('/{table}/destroy/{id}', 'CrudController@destroy')->name('crud.destroy');

});

Route::get('api/get-purchase-approval-data', 'ApprovalController@getPurchaseConfigData');
Route::get('api/get-purchase-approval-data/{id}', 'ApprovalController@getPurchaseData');

Auth::routes();


