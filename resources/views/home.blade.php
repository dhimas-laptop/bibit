@extends('layout')

@section('content')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
       <img src="{{asset('img/logo2.png')}}" width="500" height="350">
        <p class="lead text-muted">sebelum memesan pastikan dokumen anda sudah terlengkapi.</p>
        <p class="lead text-muted"> Dokumen tersebut antara lain :<br>
                <strong>KTP<br></strong>
                <strong>Fotocopy KTP<br></strong>
                <strong>Surat Keterangan<br></strong>
        </p>
        
        <p>
          <a href="/list-bibit" class="btn btn-secondary my-2">Lihat jenis Bibit yang tersedia</a>
          <a href="/order-bibit" class="btn btn-success my-2">Pesan Bibit Sekarang</a>
        </p>
      </div>
    </div>
</section>
@endsection
