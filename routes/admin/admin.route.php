<?php
$controller = \App\Http\Controllers\Admin\IndexController::class;
Route::get('/',[$controller,'index']);
