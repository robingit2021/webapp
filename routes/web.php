<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainpageController;
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

    $min_date = DB::table('event_table')->select('date_')->orderBy('date_','ASC')->first();
    $max_date = DB::table('event_table')->select('date_')->orderBy('date_','DESC')->first();
    $data['from'] = $min_date ?  date('F Y', strtotime($min_date->date_)) : null;
    $data['to'] = $max_date ? date('F Y', strtotime($max_date->date_)) : null;


    $data['event_desc'] = null;
    $data['days_check'] = DB::table('event_table')->select('day','event_desc')->orderBy('day','ASC')->distinct()->get();

    //dd($data['days_check'][0]->event_desc);

    // variable for display date range title
    if ($data['from']==$data['to'] && $data['from']!=null && $data['to']!=null)
    {
        $data['to'] = null;
        $query = DB::table('event_table')->select('event_desc')->whereRaw('LENGTH(event_desc) > 0')->orderBy('date_','ASC')->first();
        $data['event_desc'] = $query  ? $query->event_desc : '';
    }

    // variable for applying date range
    $data['from2'] = $min_date ?  $min_date->date_ : '';
    $data['to2'] = $max_date ? $max_date->date_ : '';



    return view('mainpage',$data);
});

Route::post('/save',[MainpageController::class,'save']);
Route::get('/event',[MainpageController::class,'event']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
