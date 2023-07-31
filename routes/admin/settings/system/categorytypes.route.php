<?php
$controller = \App\Http\Controllers\Admin\Settings\CategoryTypesController::class;
Route::get('/',[$controller,'index']);
Route::post('/',[$controller,'storeCategoryType']);
Route::get('/list',[$controller,'listCategoryTypes']);
Route::delete('/delete/{categorytype}',[$controller,'destroyCategoryType']);
