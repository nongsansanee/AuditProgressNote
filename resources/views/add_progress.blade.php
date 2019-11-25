@extends('layouts.app')
@section('title','add doctor')
@section('content')
@if($message = Session::get('success'))
        <div class="alert alert-success">
            {{$message}}
        </div>
 @endif

 @if($errors->any())
        <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>

                @endforeach
        </div>
@endif
<div id="app">
 <!-- @{{ doctors }} -->
    <form action="/save_progress" medthod="POST">
      <input type="hidden"  name="_token" value="{{ csrf_token()}}">
        <div class="form-row mt-5" style="background-color:#BFF484">
            <div class="col-lg-12 text-center">       
                <label>บันทึก Progress Note</label>     
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-12">       
                    <label for="exampleInputEmail1">วันที่ปัจจุบัน:</label>
                    <label for="exampleInputEmail1">
                    <?php
                    // print_r(getdate());
                    $current_date=getdate();
                    echo  "$current_date[mday]-$current_date[mon]-$current_date[year]";
                    ?>
                    </label>   
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-2">            
                    <label for="exampleInputPassword1">เลือกชื่อหอผู้ป่วย :</label>
            </div>
            <div class="col col-lg-4"> 
                    <select id="list_ward" class="form-control" name="ward" v-model="ward"> 
                    @foreach($wards as $ward)    
                     
                            <option value="{{$ward['id']}}">{{ $ward['name']}}</option>
                         
                    @endforeach
                    </select>
           
            </div>
        </div>
        <div class="row  mt-3" >
                <table id="DoctorTable" class="table table-striped">
                    <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>ชื่อแพทย์</th>
                                <th>สายปฎิบัติงาน</th>
                                <th>เลือกแพทย์ของผู้ป่วย</th>
                            </tr>
                    </thead>
                    <tbody id="DataDoctorTable" >
                        <tr v-for="(doctor, key) in doctors">
                            <td >
                                @{{doctor.id}}
                            </td>
                            <td >
                                @{{doctor.name}}
                            </td>
                            <td >
                             <label>สาย</label>
                                 @{{doctor.line}}
                            </td>
                            <td class="text-center">
                               <input class="form-check-input" type="radio" name="doctor_patient" :value="doctor.id">
                            </td>
                        </tr>
                            
                    </tbody>
                </table>
        </div>
        <div class="row">
            <div class="col col-lg-2">     
                    <label for="an"  >ใส่เลข AN ของผู้ป่วย :</label>
            </div>
            <div class="col col-lg-2">     
                    <input type="text" class="form-control" v-model="an" >
            </div>
            <div class="col col-lg-2">      
                 <button type="button" class="btn btn-primary" @click="searchPatient">ค้นหา</button>
            </div>
        </div>
        <div class="row mt-3"  style="background-color:#9BDAA5" v-if="patient.length !== 0">
             <div class="col col-lg-6">    
                <label v-text="`ชื่อผู้ป่วย : ${patient.patient_name}`" ></label> 
            </div>
            <div class="col col-lg-6">    
                <label   v-text="`วันและเวลาที่ ADMIT : ${patient.datetime_admit}`"></label>  
            </div>
       
        </div>

        <div class="row"  style="background-color:#CAC9C3" v-if="patient.his_progress_note >0" >
             <div class="col col-lg-6">    
                <label  for="exampleRadios1">
                    พบข้อมูลการตรวจสอบ progress note ดังนี้
                </label>
            </div>
        </div>

        <div class="row"  style="background-color:#CAC9C3" v-if="patient.his_progress_note >0" >
          <div class="col col-lg-12 col-sm-12">    
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">ชื่อผู้ Audit</th>
                    <th scope="col">วันที่ Audit</th>
                    <th scope="col">พบ/ไม่พบ progressnote</th>
                    <th scope="col">ชื่อแพทย์</th>
                    <th scope="col">วันที่แพทย์เขียน Progress Note</th>
                    <th scope="col">สถานะ Progress Note</th>
                    <th scope="col">หมายเหตุ(Not Complete)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>น.ส.วนิดา ใจงาม</td>
                        <td>15-10-2019</td>
                        <td>พบ</td>
                        <td>นายณเดช คุณกิติยะ</td>
                        <td>11-10-2019</td>
                        <td>Not Complete</td>
                        <td>xxxxxxxx</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                        <td>น.ส.วนิดา ใจงาม</td>
                        <td>20-10-2019</td>
                        <td>พบ</td>
                        <td>นายณเดช คุณกิติยะ</td>
                        <td>19-10-2019</td>
                        <td>Not Complete</td>
                        <td>xxxxxxxx</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                        <td>น.ส.วนิดา ใจงาม</td>
                        <td>30-10-2019</td>
                        <td>ไม่พบ</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>


        <div class="row"  style="background-color:#D3F3D7"  v-if="patient.length !== 0">
             <div class="col col-lg-3">    
                <input type="radio" name="checkNote" v-model="checkNote" value="1">
                <label  for="exampleRadios1">
                    พบการเขียน progress note
                </label>
            </div>
            <div class="col col-lg-3">    
                <input  type="radio" name="checkNote" v-model="checkNote" value="2" >
                <label class="form-check-label" for="exampleRadios1">
                    ไม่พบการเขียน progress note
                </label>
            </div>
        </div>

        <div class="row"  style="background-color:#D3F3D7"  v-if="checkNote == 1 ">
             <div class="col col-lg-6">    
                <label  for="exampleRadios1">
                    วันที่แพทย์เขียน Progress Note:
                </label>
                <input type="date" name="dateWrite"  >
            </div>
        </div>

        <div class="row"  style="background-color:#D3F3D7"  v-if="checkNote == 1 ">
             <div class="col col-lg-3" v-if="checkWriteResident == true ">    
                <input type="radio" name="dateComplete"  value="1">
                <label  for="exampleRadios1">
                    มีวันที่และอ่านออก
                </label>
            </div>
            <div class="col col-lg-3" v-if="checkWriteResident == true ">    
                <input type="radio" name="dateComplete"  value="2">
                <label  for="exampleRadios1">
                    มีวันที่แต่อ่านไม่ออก
                </label>
            </div>
            <div class="col col-lg-3" v-if="checkWriteResident == true ">    
                <input type="radio" name="dateComplete"  value="3">
                <label  for="exampleRadios1">
                    ไม่มีวันที่
                </label>
            </div>
        </div>

        <div class="row"  style="background-color:#D3F3D7"  v-if="checkNote == 1 ">
             <div class="col col-lg-3">    
                <input type="checkbox" name="writeUnitOther"  value="1">
                <label  for="exampleRadios1">
                    เขียนโดยหน่วยอื่น
                </label>
            </div>
        </div>

        <div class="row"  style="background-color:#D3F3D7"  v-if="checkNote == 1 ">
             <div class="col col-lg-3">    
                <input type="checkbox" name="writeResident" v-model="checkWriteResident" value="2">
                <label  for="exampleRadios1">
                    เขียนโดย resident ward
                </label>
            </div>
            <div class="col col-lg-3" v-if="checkWriteResident == true ">    
                <input type="radio" name="residentID"  value="1">
                <label  for="exampleRadios1">
                    มีเลข ว และอ่านออก
                </label>
            </div>
            <div class="col col-lg-3" v-if="checkWriteResident == true ">    
                <input type="radio" name="residentID"  value="2">
                <label  for="exampleRadios1">
                    มีเลข ว แต่อ่านไม่ออก
                </label>
            </div>
            <div class="col col-lg-3" v-if="checkWriteResident == true ">    
                <input type="radio" name="residentID"  value="3">
                <label  for="exampleRadios1">
                    ไม่มีเลข ว 
                </label>
            </div>
        </div>

        <div class="row"  style="background-color:#D3F3D7"  v-if="checkNote == 1 ">
             <div class="col col-lg-3">    
                <input type="checkbox" name="writeExtern" v-model="checkWriteExtern"  value="3">
                <label  for="exampleRadios1">
                    เขียนโดย Extern
                </label>
            </div>
            <div class="col col-lg-3" v-if="checkWriteExtern == true ">    
                <input type="radio" name="MDSign"  v-model="checkMDSign" value="1">
                <label  for="exampleRadios1">
                    มี MD sign
                </label>
            </div>
            <div class="col col-lg-3" v-if="checkWriteExtern == true ">    
                <input type="radio" name="MDSign" v-model="checkMDSign" value="2">
                <label  for="exampleRadios1">
                    ไม่มี MD sign
                </label>
            </div>
        </div>
        
        
        <div class="row"  style="background-color:#D3F3D7"  v-if="checkMDSign == 1 && checkNote == 1 ">
             <div class="col col-lg-3">    
              
                <label  for="exampleRadios1">
                  
                </label>
            </div>
            <div class="col col-lg-3">    
                <input type="radio" name="mdID"  value="1">
                <label  for="exampleRadios1">
                    มีเลข ว และอ่านออก
                </label>
            </div>
            <div class="col col-lg-3">    
                <input type="radio" name="mdID"  value="2">
                <label  for="exampleRadios1">
                    มีเลข ว แต่อ่านไม่ออก
                </label>
            </div>
            <div class="col col-lg-3">    
                <input type="radio" name="mdID"  value="3">
                <label  for="exampleRadios1">
                    ไม่มีเลข ว 
                </label>
            </div>
        </div>


        <div class="row"  style="background-color:#D3F3D7"  v-if="checkNote == 1 ">
             <div class="col col-lg-9">    
                <input type="checkbox" name="writeOther" v-model="checkWriteOther"  value="4">
                <label  for="exampleRadios1">
                    เขียนโดยผู้อื่น โปรดระบุ
                </label>
                <input type="text" name="writeOtherDetail" size="50">          
            </div>
           
        </div>
        
        
        <div class="row"  style="background-color:#D3F3D7"  v-if="checkWriteOther == true && checkNote == 1 ">
             <div class="col col-lg-3">    
                <label  for="exampleRadios1">
                </label>
            </div>
            <div class="col col-lg-3">    
                <input type="radio" name="otherID"  value="1">
                <label  for="exampleRadios1">
                    มีเลข ว และอ่านออก
                </label>
            </div>
            <div class="col col-lg-3">    
                <input type="radio" name="otherID"  value="2">
                <label  for="exampleRadios1">
                    มีเลข ว แต่อ่านไม่ออก
                </label>
            </div>
            <div class="col col-lg-3">    
                <input type="radio" name="otherID"  value="3">
                <label  for="exampleRadios1">
                    ไม่มีเลข ว 
                </label>
            </div>
        </div>

        <div class="row"  style="background-color:#9BDAA5"  v-if="checkNote == 1 ">
             <div class="col col-lg-3"> 
                <label  for="exampleRadios1">
                   สรุป Progress Note
                </label>   
            </div>
            <div class="col col-lg-3"> 
                <input type="radio" name="completeNote" v-model="completeNote" value="1" >
                <label  for="exampleRadios1">
                    complete
                </label>
            </div>
            <div class="col col-lg-3"> 
                <input type="radio" name="completeNote" v-model="completeNote" value="2"  >
                <label  for="exampleRadios1">
                    not complete โปรดระบุ
                </label>
            </div>
        </div>
        

        <div class="row"  style="background-color:#9BDAA5; height: 80px"  v-if="checkNote == 1 && completeNote==2 ">
             <div class="col col-lg-3"> 
                <label  for="exampleRadios1">
                
                </label>   
            </div>
            <div class="col col-lg-3"> 
                
            </div>
            <div class="col col-lg-6"> 
                <textarea class="form-control" id="completeNoteDetail" rows="2"></textarea>
            </div>
        </div>

        <div class="row text-center mt-5" id="btn-save" v-if="completeNote !== 0 || checkNote == 2">
            <div class="col col-lg-12 ">  
                 <button type="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </div>
        <!-- @{{patient}}
      @{{ doctors }} -->
    </form>
</div>
@endsection

@section('extra-script')
<script>
var app = new Vue({
        el:"#app",
        data:{
            doctors:[],
            ward: null,
            an: null,
            patient: [],
            checkNote:0,
            checkWriteResident:0,
            checkWriteExtern:0,
            checkMDSign:0,
            checkWriteOther:0,
            completeNote:0
          
            
        },
        mounted(){
             document.querySelector("#list_ward").addEventListener("change", this.addDoctor);
            
        },
        methods:{
            addDoctor() {
                console.log(this.ward)
                axios.post('/get-line-doctors', {
                    ward_id: this.ward,
                })
                .then((response) => {
                    this.doctors = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });                
            },
            searchPatient(){
                console.log(this.an);
                axios.post('/get-patient', {
                    an_patient: this.an,
                })
                .then((response) => {
                    this.patient = response.data;
                    console.log(this.patient);
                })
                .catch((error) => {
                    console.log(error);
                });                
            },
        

        }

});
</script>
@endsection

