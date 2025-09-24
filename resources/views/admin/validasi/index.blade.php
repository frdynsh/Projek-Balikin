@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Validasi Barang Temuan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-6 mb-3">
                <div class="card p-3">
                    <h5>{{ $post->nama_barang }}</h5>
                    <p>{{ Str::limit($post->deskripsi_barang, 100) }}</p>
                    <p><small>{{ $post->tgl_penemuan }} di {{ $post->lokasi_penemuan }}</small></p>

                    <form action="{{ route('admin.validasi.approve', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-success">Setujui</button>
                    </form>

                    <form action="{{ route('admin.validasi.reject', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-danger">Tolak</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Tidak ada laporan yang menunggu validasi.</p>
        @endforelse
    </div>
</div>
@endsection
