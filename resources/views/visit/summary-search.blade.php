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
                            Filter Tanggal
                          </button>
                        </h2>
  
                        <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
                            <form action="{{ route('visit.summary-search') }}" method="GET">
                                <div class="accordion-body">
                                    <input type="date" name="from" class="form-control col-md-6" aria-label="Tanggal Mulai" value="{{ date('Y-m-01') }}">
                                    <input type="date" name="to" class="form-control col-md-6" aria-label="Tanggal Selesai" value="{{ date('Y-m-t') }}">
                                    <input type="submit" class="btn btn-primary mt-2">&nbsp;
                                    <a class="btn btn-secondary mt-2" href="{{ route('visit.summary') }}">Reset Filter</a>
                                </div>
                            </form>
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
@endpush