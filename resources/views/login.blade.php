@extends('layout')

@section('content')

    <form style="margin-top: 5%;margin-left: 30%;margin-right: 30%;" action="#" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="ohyes" placeholder="Nomor Induk Kependudukan">
        </div>
        <div class="input-group mb-3">
            <input type="date" class="form-control" name="ohyes" placeholder="tgl_lahir">
        </div>
        <div class="input-group mb-3">
            <button type="button" ></button>
        </div>
    </form>
    
@endsection