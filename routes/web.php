<?php

Auth::routes();

Route::get('/','DomainsController@index');
Route::get('domains/{domain}','DomainsController@show');
Route::post('domains','DomainsController@store');
Route::put('domains/{domain}','DomainsController@update');

Route::get('domain-list','DownloadDomainListController');