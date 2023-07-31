<?php
$controller = \App\Http\Controllers\Admin\Calendar\IndexController::class;
Route::get('/',[$controller,'index']);
