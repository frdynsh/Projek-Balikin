@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Edit Barang Temuan</h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('barang_temuan.update', $barangTemuan->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @include('barang_temuan._form', ['submitText' => 'Update', 'barangTemuan' => $barangTemuan])
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
