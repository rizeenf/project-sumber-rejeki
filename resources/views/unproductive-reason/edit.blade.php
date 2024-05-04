@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> --}}

    <div class="row">
      <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Tambah Alasan Tidak Produktif</h5>
          <!-- Form -->
          <div class="card-body">
            <form method="POST" action="{{ route('unproductive-reason.update', $reason->id) }}">
                @csrf
                @method('PUT')
              <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="name" class="form-label">Nama</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ $reason->name }}"/>
                </div>

                <div class="col-md mb-2">
                  <small class="text-light fw-semibold d-block">Tipe</small>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" id="type" value="S" name="type" {{ $reason->type == 'S' ? 'checked' : ''}}>
                    <label class="form-check-label" for="inlineRadio1">Toko</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="type" value="O" name="type" {{ $reason->type == 'O' ? 'checked' : ''}}>
                    <label class="form-check-label" for="inlineRadio2">Gerai</label>
                  </div>
                </div>
              </div>
              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('unproductive-reason.index') }}" class="btn btn-outline-secondary">Kembali</a>
              </div>
            </form>
          </div>
          <!-- /Form -->
        </div>

      </div>
    </div>
  </div>
@endsection