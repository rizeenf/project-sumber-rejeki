@extends('layouts.master')

@section('content')
<!-- Bordered Table -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <h5>Tabel Summary Kunjungan Karyawan</h5>
                <div class="card-header-action">
                    <div class="card accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
                            Filter
                          </button>
                        </h2>
  
                        <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
                            <div class="accordion-body">
                                <label for="" class="form-label mt-2">Tanggal Mulai</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" aria-label="Tanggal Mulai" value="{{ date('Y-m-01') }}">
                                <label for="" class="form-label mt-2">Tanggal Selesai</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" aria-label="Tanggal Selesai" value="{{ date('Y-m-t') }}">
                                <select name="staff" id="staff" class="form-control">
                                    <option value="">--Pilih Nama Staff--</option>
                                    @foreach ($users as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('visit.store-export') }}" class="btn btn-success mt-3">Export Kunjungan Toko ke Excel</a>
                    <a href="{{ route('visit.outlet-export') }}" class="btn btn-warning mt-3">Export Kunjungan Gerai ke Excel</a>
                    
                    {{-- <a href="{{ route('unproductive-reason.create') }}" class="btn btn-primary"><box-icon name='plus' ></box-icon> Tambah Data</a> --}}
                    {{-- <a href="{{ route('category.trashed') }}" class="btn btn-secondary"><box-icon name='plus' ></box-icon> Data Terhapus</a> --}}
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
        $('#start_date').change(function(){
            $('.table').DataTable().draw();
        });
        
        $('#end_date').change(function(){
            $('.table').DataTable().draw();
        });

        $('#staff').change(function(){
            $('.table').DataTable().draw();
        });
    </script>
@endpush