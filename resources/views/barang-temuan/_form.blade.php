@csrf

<div class="mb-3">
    <label class="form-label">Nama Barang</label>
    <input type="text" name="nama_barang" class="form-control" 
           value="{{ old('nama_barang', $barangTemuan->nama_barang ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi Barang</label>
    <textarea name="deskripsi_barang" class="form-control" rows="3">{{ old('deskripsi_barang', $barangTemuan->deskripsi_barang ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Tanggal Penemuan</label>
    <input type="date" name="tgl_penemuan" class="form-control" 
           value="{{ old('tgl_penemuan', $barangTemuan->tgl_penemuan ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Lokasi Penemuan</label>
    <input type="text" name="lokasi_penemuan" class="form-control" 
           value="{{ old('lokasi_penemuan', $barangTemuan->lokasi_penemuan ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Upload Gambar (opsional)</label>
    <input type="file" name="gambar" class="form-control">
    @if(!empty($barangTemuan->gambar))
        <small class="d-block mt-1">Gambar saat ini: <img src="{{ asset('storage/'.$barangTemuan->gambar) }}" height="80"></small>
    @endif
</div>

<div class="text-end">
    <button type="submit" class="btn btn-primary px-4">{{ $submitText ?? 'Simpan' }}</button>
    <a href="{{ route('barang-temuan.index') }}" class="btn btn-secondary">Batal</a>
</div>
