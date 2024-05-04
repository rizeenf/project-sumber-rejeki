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

                        <select name="brand" id="brand" class="form-control mt-2">
                            <option value="">--Pilih Brand Produk--</option>
                                @foreach ($brands as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            <option value="NULL">Tidak Diketahui</option>
                        </select>

                        <select name="subbrand" id="subbrand" class="form-control mt-2">
                            <option value="">--Pilih Sub Brand Produk--</option>
                                @foreach ($subBrands as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            <option value="NULL">Tidak Diketahui</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <h5>Tabel Produk</h5>
                <div class="card-header-action">
                        <a href="{{ route('product.create') }}" class="btn btn-primary"><box-icon name='plus' ></box-icon> Tambah Data</a>
                        <a href="{{ route('product.trashed') }}" class="btn btn-secondary"><box-icon name='plus' ></box-icon> Data Terhapus</a>
                        <a href="{{ route('product.export') }}" class="btn btn-success">Export ke excel</a>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            Import dari Excel
                        </button>

                        <!-- Modal Import -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('product.import') }}" enctype="multipart/form-data" method="POST">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    <label for="import" class="form-label">Unggah File</label>
                                    <input type="file" name="import" class="form-control mb-2">
                                    <a href="{{ route('product.file-import', 'Format Impor Produk - SMOffice.xlsx') }}" class="mt-2">Unduh Contoh File Disini</a>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                            </div>
                            </form>
                        </div>
                    
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

        $('#brand').change(function(){
            $('.table').DataTable().draw();
        });

        $('#subbrand').change(function(){
            $('.table').DataTable().draw();
        });
    </script>
@endpush