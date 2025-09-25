@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Form Tambah Barang Hilang</h3>
    <form action="{{ route('lostitems.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control">

        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>

        <label>Tanggal Kehilangan</label>
        <input type="date" name="tanggal" class="form-control">

        <label>Lokasi Kehilangan</label>
        <input type="text" name="lokasi" class="form-control">

        <label>Upload Gambar</label>
        <input type="file" name="gambar" class="form-control">

        <button type="submit" class="btn btn-primary mt-3">Upload</button>
    </form>
</div>
@endsection
