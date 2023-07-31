<?php
$controller = \App\Http\Controllers\Admin\Settings\System\IndexController::class;
Route::get('/',[$controller,'index']);
