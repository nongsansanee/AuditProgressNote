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
    return view('welcome');
});

Route::get('/show_doctor', function () {
    return view('show_doctor');
});

Route::get('/add_progress', function () {
    return view('add_progress');
});

Route::post('/get-doctors', function(){
    $doctors[] =  [ 'id' => 1 ,'name' => 'นายณเดช คุณกิติยะ' ];
    $doctors[] = [ 'id' => 2 ,'name' => 'นางศันสนีย์ คุณกิติยะ' ];
    return $doctors;
});

Route::post('/get-line-doctors', function(){
    //  return $ward_id;
    $doctors[] =  [ 'id' => 1 ,'name' => 'นายณเดช คุณกิติยะ','line' => 'A' ];
    $doctors[] = [ 'id' => 2 ,'name' => 'นางศันสนีย์ คุณกิติยะ','line' => 'B' ];
    return $doctors;
});

Route::post('/get-patient', function(){
    //  return $ward_id;
    // $patient[] =  [ 'id' => 1 ,'patient_name' => 'นางสาวอุรัสยา จงใจดี','datetime_admit' => '11-10-2019' ];
    $patient =  [ 'id' => 1 ,'patient_name' => 'นางสาวอุรัสยา จงใจดี','datetime_admit' => '11-10-2019 06:11:00' ];

    return $patient;
});