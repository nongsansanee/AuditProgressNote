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
    $wards[] = ['id'=>1,'name'=>'อัษฎางค์ 6 เหนือ'];
    $wards[] = ['id'=>2,'name'=>'อัษฎางค์ 6 ใต้'];
    $wards[] = ['id'=>3,'name'=>'อัษฎางค์ 9 เหนือ'];
    $wards[] = ['id'=>4,'name'=>'อัษฎางค์ 9 ใต้'];

  
    return view('show_doctor')->with(['wards'=>$wards]);
});

Route::get('/add_progress', function () {
    $wards[] = ['id'=>1,'name'=>'อัษฎางค์ 6 เหนือ'];
    $wards[] = ['id'=>2,'name'=>'อัษฎางค์ 6 ใต้'];
    $wards[] = ['id'=>3,'name'=>'อัษฎางค์ 9 เหนือ'];
    $wards[] = ['id'=>4,'name'=>'อัษฎางค์ 9 ใต้'];

    return view('add_progress')->with(['wards'=>$wards]);
});

Route::post('/get-doctors', function(){

    $ward_id =  request()->input('ward_id');
    $current_date=getdate();
    $date_search = "$current_date[mday]-$current_date[mon]-$current_date[year]";

    Log::debug($ward_id);
    Log::debug($date_search);
    if($ward_id == '1'){
        $doctors[] =  [ 'id' => 1 ,'name' => 'นพ.ณเดช คุณกิติยะ'   ];
        $doctors[] = [ 'id' => 2 ,'name' => 'พญ.ศันสนีย์ คุณกิติยะ' ];
        return $doctors;
    }

        $doctors[] =  [ 'id' => 3 ,'name' => 'นพ.วัชระ คนดี'   ];
        $doctors[] = [ 'id' => 4 ,'name' => 'นพ.อาคม มหาศาล' ];
        return $doctors;
});

Route::post('/get-line-doctors', function(){
  
    $ward_id =  request()->input('ward_id');
    if($ward_id == '1'){
        $doctors[] =  [ 'id' => '123456' ,'name' => 'นพ.ณเดช คุณกิติยะ','line' => 'A' ];
        $doctors[] = [ 'id' => '234567' ,'name' => 'พญ.ศันสนีย์ คุณกิติยะ','line' => 'B' ];
        return $doctors;
    }
    $doctors[] =  [ 'id' => '345678' ,'name' => 'นพ.วัชระ คนดี','line' => 'A' ];
    $doctors[] = [ 'id' => '456789' ,'name' => 'นพ.อาคม มหาศาล','line' => 'B' ];
    return $doctors;
});

Route::post('/get-patient', function(){
   
   
    // Log::debug("test write log");
    // Log::debug(request()->input('an_patient'));

    $an =  request()->input('an_patient');
    // Log::debug($an);

    if($an == '123'){
        $patient =  [ 'id' => 1 ,'patient_name' => 'นางสมศรี น้ำใจมาก','datetime_admit' => '02-10-2019 06:11:00','his_progress_note'=>'3'];
        return $patient;
    }
  
    $patient =  [ 'id' => 1 ,'patient_name' => 'นางสาวอุรัสยา จงใจดี','datetime_admit' => '11-10-2019 06:11:00','his_progress_note'=>'0'];

    return $patient;
});

Route::get('/save_progress',function(Illuminate\Http\Request $request){

    $validate = [
        'doctor_patient' => 'required',
      
    ];

    $errorMsg = [
        'doctor_patient.required' => 'กรุณาเลือกแพทย์',
    ];

    $request->validate($validate,$errorMsg);

    return redirect()->back()->with('success','Create Successfully');
     return $request->all();  
    
});