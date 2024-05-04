@extends('layouts.master')

@section('content')
<!-- Bordered Table -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h5>Tabel Galery Foto</h5>
                <div class="card-header-action">
                        <a href="{{ route('display.create') }}" class="btn btn-primary"><box-icon name='plus' ></box-icon> Tambah Data</a>
                        <a href="{{ route('display.trashed') }}" class="btn btn-secondary"><box-icon name='plus' ></box-icon> Data Terhapus</a>
                    <div class="form-group">
                        <label><strong>Tipe :</strong></label>
                        <select id='type' name="type" class="form-control" style="width: 200px">
                            <option value="">--Select Tipe--</option>
                            <option value="V">Visit</option>
                            <option value="D">Display</option>
                            <option value="S">Sampel</option>
                        </select>
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
        $('#type').change(function(){
            $('.table').DataTable().draw();
        });
    </script>
@endpush