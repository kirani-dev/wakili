<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/tests', [\App\Http\Controllers\Tests\TestsController::class,'index']);


Route::group(['middleware'=>['auth','web','verified','member']],function(){
    Route::get('/dashboard', [\App\Http\Controllers\Admin\IndexController::class,'index'])->name('dashboard');

    $agent = new \Jenssegers\Agent\Agent();

    Route::get('home', [\App\Http\Controllers\HomeController::class,'index']);
    $routes_path = base_path('routes');
    $route_files = File::allFiles(base_path('routes'));

    foreach ($route_files as $file) {
        $path = $file->getPath();
     
        if ($path != $routes_path) {
            $file_name = $file->getFileName();
            $prefix = str_replace($file_name, '', $path);
            $prefix = str_replace($routes_path, '', $prefix);
            $file_path = $file->getPathName();
            $this->route_path = $file_path;
            $arr = explode('/', $prefix);
            //if windows and path not similar to linux
            $agent->is('Windows')  ? $arr = explode('\\', $prefix) : $arr = explode('/', $prefix);

            $len = count($arr);
            $main_file = $arr[$len - 1];

            $arr = array_map('ucwords', $arr);
            $arr = array_filter($arr);
            $ext_route = str_replace('index.route.php', '', $file_name);
            $ext_route = str_replace($main_file, '', $ext_route);
            $ext_route = str_replace('.route.php', '', $ext_route);
            $ext_route = str_replace('web', '', $ext_route);

            // if windows and path isn't similar to linux
           if ($agent->is('Windows'))
               $prefix = str_replace('\\', '/', strtolower($prefix . '/'.$ext_route));
           else
              $prefix = strtolower($prefix. '/' . $ext_route);

           $implode = ($agent->is('Windows')) ? implode('/', $arr)  : implode('\\', $arr) ;
     
            Route::group(['namespace' => $implode, 'prefix' => $prefix ], function () {
                require $this->route_path;
            });
        }
    }
});

