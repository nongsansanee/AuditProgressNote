@extends('layouts.app')
@section('title','add doctor')
@section('content')

<div id="app">
 <!-- @{{ doctors }} -->
    <form action="/add_progress">
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
                    <select id="list_ward" class="form-control" v-model="ward">                   
                        <option value="1">อัษฎางค์ 6 เหนือ</option>
                        <option value="2">อัษฎางค์ 6 ใต้</option>
                        <option value="3">อัษฎางค์ 9 เหนือ</option>
                        <option value="4">อัษฎางค์ 9 ใต้</option>
                    </select>
           
            </div>
        </div>
        <div class="row  mt-3">
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
                               <input class="form-check-input" type="radio" name="doctor_patient">
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
        <div class="row"  style="background-color:#D3F3D7"  v-if="patient.length !== 0">
             <div class="col col-lg-3">    
                <input type="radio" name="exampleRadios" id="pg-note"  value="1">
                <label  for="exampleRadios1">
                    พบการเขียน progress note
                </label>
            </div>
            <div class="col col-lg-3">    
                <input  type="radio" name="exampleRadios" id="pg-note" value="2" >
                <label class="form-check-label" for="exampleRadios1">
                    ไม่พบการเขียน progress note
                </label>
            </div>
        </div>

        
        <div class="row text-center mt-5" id="btn-save">
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
            // doctors:[
            //         {id:1 ,name:"นายณเดช คุณกิติยะ"},
            //         {id:2 ,name:"นางศันสนีย์ คุณกิติยะ"}
            //         ],

            
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
                    an: this.an,
                })
                .then((response) => {
                    this.patient = response.data;
                    console.log(this.patient);
                })
                .catch((error) => {
                    console.log(error);
                });                
            }
        }

});
</script>
@endsection

