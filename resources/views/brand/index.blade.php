@extends('layouts.master')

@section('content')
<!-- Bordered Table -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
                    Filter
                  </button>
                </h2>

                <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
                    <div class="accordion-body">
                        <select name="category" id="category" class="form-control">
                            <option value="">--Pilih Kategori Produk--</option>
                                @foreach ($categories as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            <option value="NULL">Tidak Diketahui</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <h5>Tabel Brand Produk</h5>
                <div class="card-header-action">
                        <a href="{{ route('brand.create') }}" class="btn btn-primary"><box-icon name='plus' ></box-icon> Tambah Data</a>
                        <a href="{{ route('brand.trashed') }}" class="btn btn-secondary"><box-icon name='plus' ></box-icon> Data Terhapus</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
    <!--/ Bordered Table -->
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $('#category').change(function(){
            $('.table').DataTable().draw();
        });
    </script>
@endpush