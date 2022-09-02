@extends('layout')
@section('content')
<div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($bibit as $data)
          <div class="col">
            <div class="card shadow-sm">
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" src="{{ asset('img/'.$data->file) }}" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

              <div class="card-body">
                <p class="card-text">Bibit Pohon {{ $data->nama }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Pesan</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Tambah Keranjang</button>
                  </div>
                  <small class="text-muted">{{ $data->jumlah }} Batang Bibit tersedia</small>
                </div>
              </div>
            </div>
          </div>    
        @endforeach
        
      </div>
    </div>
  </div>
  @endsection