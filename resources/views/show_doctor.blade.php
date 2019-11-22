@extends('layouts.app')
@section('title','add doctor')
@section('content')

    <form>
    <div class="form-row mt-5">
        <div class="col-lg-12 text-center">       
            <label>บันทึกสายการปฎิบัติงานของแพทย์ประจำหอผู้ป่วย</label>     
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4">       
                <label for="exampleInputEmail1">วันที่ปัจจุบัน:</label>
                <label for="exampleInputEmail1">21-11-2562</label>   
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4">
            <div class="form-group">
                <label for="exampleInputPassword1">เลือกชื่อหอผู้ป่วย</label>
                <select id="inputState" >
                    <option>อัษฎางค์ 6 เหนือ</option>
                    <option>อัษฎางค์ 6 ใต้</option>
                    <option>อัษฎางค์ 9 เหนือ</option>
                    <option>อัษฎางค์ 9 ใต้</option>
                 </select>
            </div>
        </div>

    </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection