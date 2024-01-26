@extends('layout')
@section('css')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="">
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
<style>
    html, body {
        height: 100%;
        margin: 0;
    }
    .leaflet-container {
        height: 400px;
        width: 750px;
        max-width: 100%;
        max-height: 100%;
    }
</style>

@endsection

@section('content')
    <section class="container ">
        <div class="row p-lg-5">
            <div class="col-lg-10 mx-auto my-auto">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="/order-bibit">
                            @csrf

                            {{-- data diri --}}
                            <div class="text-center mb-4"><strong>-----------------Data Diri-----------------</strong></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jenis</label>
                                <select class="col-sm-10 form-control" id="jenis" name="satuan">
                                    <option value="perorangan">Perorangan</option>
                                    <option value="kelompok">Kelompok</option>
                                </select>
                            </div>
                            <div class="form-group row kelompok" style="display: none">
                                <label class="col-sm-2 col-form-label">Nama Kelompok</label>
                                <input type="text" class="col-sm-10 form-control  @error('kelompok') is-invalid @enderror" style="text-transform: uppercase" name="kelompok" placeholder="masukkan nama Kelompok">
                            </div> 
                            <div class="form-group row kelompok" style="display: none">
                                <label class="col-sm-2 col-form-label">Nama Ketua Kelompok</label>
                                <input type="text" class="col-sm-10 form-control  @error('nama') is-invalid @enderror" style="text-transform: uppercase" name="nama_ketua" placeholder="Nama Ketua Kelompok">
                            </div>  
                            <div class="form-group row" id="tutup">
                                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <input type="text" class="col-sm-10 form-control  @error('nama') is-invalid @enderror" style="text-transform: uppercase" name="nama_pemohon" placeholder="masukkan nama Lengkap">
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <input type="text" class="col-sm-10 form-control  @error('alamat') is-invalid @enderror" style="text-transform: uppercase" name="alamat" placeholder="Isi Alamat lengkap">
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No. Telpon / HP</label>
                                <input type="text" class="col-sm-10 form-control  @error('no_telp') is-invalid @enderror" style="text-transform: uppercase" name="no_telp" placeholder="08xxx">
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kegiatan</label>
                                <input type="text" class="col-sm-10 form-control  @error('kegiatan') is-invalid @enderror" style="text-transform: uppercase" name="kegiatan" placeholder="Isi Nama Kegiatan yang Dilakukan">
                            </div>  
                            {{-- data diri end --}}

                            {{-- data lahan --}}
                            <div class="text-center mb-4"><strong>-----------------Data Lahan-----------------</strong></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Luas Lahan</label>
                                <input type="number" class="col-sm-10 form-control  @error('luas') is-invalid @enderror" style="text-transform: uppercase" name="luas" placeholder="jumlah hektar">
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alamat Lahan</label>
                                <input type="text" class="col-sm-10 form-control  @error('alamat_lahan') is-invalid @enderror" style="text-transform: uppercase" name="alamat_lahan" placeholder="alamat lahan">
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Latitude</label>
                                <input type="text" class="col-sm-10 form-control  @error('latitude') is-invalid @enderror" style="text-transform: uppercase" name="latitude" id="lat" value="" readonly>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Longitude</label>
                                <input type="text" class="col-sm-10 form-control  @error('longitude') is-invalid @enderror" style="text-transform: uppercase" name="longitude" id="lng" value="" readonly>
                            </div> 
                            
                            <div id="map"></div>
                            {{-- data lahan end --}}

                            {{-- data pesanan --}}
                            <div class="text-center my-4"><strong>-----------------Data Pesanan-----------------</strong></div>
                            <div class="after">
                            <div class="form-group row">
                                <label class="col-form-label" style="width: 100px">Bibit</label>
                                    <select class="form-control mx-1" name="bibit[]" style="width: 200px">
                                        <option>--Pilih Bibit--</option>
                                        @foreach ( $bibit as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama}}</option>
                                        @endforeach
                                    </select>
                            
                                    <div style="width: 120px"><input type="number" class="form-control counter" name="jumlah[]" placeholder="jumlah"></div>
                                <label style="margin: 5px">batang</label>
                                <button type="button" class="btn btn-primary col-sm-2 mx-2 add"><i class="fa fa-plus-square"></i> tambah lagi</button>
                            </div>
                            </div>
                            {{-- data pesanan end --}}
                            <div class="copy invisible">
                                <div class="form-group row">
                                    <label class="col-form-label" style="width: 100px">Bibit</label>
                                    <select class="form-control mx-1" name="bibit[]" style="width: 200px">
                                        <option>--Pilih Bibit--</option>
                                        @foreach ( $bibit as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama}}</option>
                                        @endforeach
                                    </select>
                                    <div style="width: 120px"><input type="number" class="form-control counter" name="jumlah[]" placeholder="jumlah"></div>
                                    <label style="margin: 5px">batang</label>  
                                    <button type="button" class="btn btn-danger col-sm-2 mx-2 remove"><i class="fa fa-trash"></i> hapus</button>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" onclick="window.history.back()">kembali</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>        
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@section('script')
    <script src="{{ asset('added/select.js')}}"></script>
    <script src="{{ asset('added/map.js')}}"></script>
    {{-- <script>
        $('.counter').change(function () { 
           
            var total = 0;
            
            var element = document.getElementsByClassName('counter').value;
            
           
            
            document.getElementById('total').value = element;

        }); 
           
    </script> --}}
@endsection