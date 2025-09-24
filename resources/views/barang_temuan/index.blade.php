@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Barang Temuan</h1>

    <div class="row">
        @forelse($items as $item)
            <div class="col-md-4 mb-3">
                <div class="card">
                    @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" class="card-img-top" alt="gambar">
                    @endif
                    <div class="card-body">
                        <h5>{{ $item->nama_barang }}</h5>
                        <p>{{ Str::limit($item->deskripsi_barang, 100) }}</p>
                        <p><small>{{ $item->tgl_penemuan }} di {{ $item->lokasi_penemuan }}</small></p>
                        <a href="{{ route('barang-temuan.show', $item->id) }}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada barang temuan.</p>
        @endforelse
    </div>
</div>
@endsection
