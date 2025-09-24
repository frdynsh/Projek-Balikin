@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $item->nama_barang }}</h1>
    @if($item->gambar)
        <img src="{{ asset($item->gambar) }}" style="max-width:300px;" class="mb-3">
    @endif
    <p><strong>Deskripsi:</strong> {{ $item->deskripsi_barang }}</p>
    <p><strong>Tanggal Penemuan:</strong> {{ $item->tgl_penemuan }}</p>
    <p><strong>Lokasi Penemuan:</strong> {{ $item->lokasi_penemuan }}</p>
    <a href="{{ route('barang-temuan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
