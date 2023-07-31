<?php
$controller = \App\Http\Controllers\Admin\Settings\System\CategoryTypeItemsController::class;
Route::get('/',[$controller,'index']);
Route::post('/',[$controller,'storeCategoryTypeItem']);
Route::get('/list',[$controller,'listCategoryTypeItems']);
Route::delete('/delete/{categorytypeitem}',[$controller,'destroyCategoryTypeItem']);
