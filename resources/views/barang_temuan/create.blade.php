@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Barang Temuan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('barang-temuan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required>
        </div>
        <div>
            <label>Deskripsi Barang</label>
            <textarea name="deskripsi_barang">{{ old('deskripsi_barang') }}</textarea>
        </div>
        <div>
            <label>Tanggal Penemuan</label>
            <input type="date" name="tgl_penemuan" value="{{ old('tgl_penemuan') }}" required>
        </div>
        <div>
            <label>Lokasi Penemuan</label>
            <input type="text" name="lokasi_penemuan" value="{{ old('lokasi_penemuan') }}" required>
        </div>
        <div>
            <label>Gambar (opsional)</label>
            <input type="file" name="gambar">
        </div>
        <button type="submit">Kirim</button>
    </form>
</div>
@endsection
