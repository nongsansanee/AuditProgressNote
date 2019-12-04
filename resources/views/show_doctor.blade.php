@extends('layouts.app')
@section('title','add doctor')
@section('content')

<div id="app">
 <!-- @{{ doctors }} -->
    <form action="/add_progress">
        <div class="form-row mt-5" style="background-color:lightblue">
            <div class="col-lg-12 text-center">       
                <label>บันทึกสายการปฎิบัติงานของแพทย์ประจำหอผู้ป่วย</label>     
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
        <div class="row mt-3">
                <table id="DoctorTable" class="table table-striped">
                    <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อแพทย์</th>
                                <th>เลือกสายปฎิบัติงาน</th>
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
                             <label for="exampleInputPassword1">เลือกสาย</label>
                                <select id="line" >
                                    <option>กรุณาเลือก</option>
                                    <option>A</option>
                                    <option>B</option>
                                </select>
                            </td>
                        </tr>
                            
                    </tbody>
                </table>
        </div>
        <button type="submit" class="btn btn-primary">บันทึก</button>

      <!-- @{{ doctors }} -->
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
                axios.post('/get-doctors', {
                    ward_id: this.ward,
                })
                .then((response) => {
                    this.doctors = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });                
            }
        }

});
</script>
@endsection

