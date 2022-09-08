@extends('layout')
@section('content')
<div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($bibit as $data)
          <div class="col">
            <div class="card shadow-sm">
              <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="{{ asset('img/'.$data->file) }}" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">

              <div class="card-body">
                <p class="card-text">Bibit Pohon {{ $data->nama }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <small class="text-muted"> <strong style="color: blue"> {{ $data->jumlah }} </strong>Batang Bibit tersedia</small>
                </div>
              </div>
            </div>
          </div>    
        @endforeach
        <button class="btn btn-danger" onclick="window.history.back()" style="position: fixed;right: 15px;bottom: 15px;height: 100px;width: 100px;"><i class="fa-solid fa-circle-chevron-left mt-3" style="width: 25px;height: 25px"></i> Kembali</button>
        
      </div>
    </div>
  </div>
  @endsection