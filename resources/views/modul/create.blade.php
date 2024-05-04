@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> --}}

    <div class="row">
      <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Tambah Modul</h5>
          <!-- Form -->
          <div class="card-body">
            <form method="POST" action="{{ route('modul.store') }}">
                @csrf
              <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="name" class="form-label">Nama</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}"/>
                </div>
                
                <div class="table-responsive text-nowrap mb-2">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Lihat</th>
                          <th>Detail</th>
                          <th>Tambah</th>
                          <th>Ubah</th>
                          <th>Hapus</th>
                          <th>Expor</th>
                          <th>Impor</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" id="view" name="view">
                            </div>
                          </td>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" id="detail" name="detail">
                            </div>
                          </td>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" id="create" name="create">
                            </div>
                          </td>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" id="edit" name="edit">
                            </div>
                          </td>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" id="delete" name="delete">
                            </div>
                          </td>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" id="export" name="export">
                            </div>
                          </td>
                          <td>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" id="import" name="import">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('modul.index') }}" class="btn btn-outline-secondary">Kembali</a>
              </div>
            </form>
          </div>
          <!-- /Form -->
        </div>

      </div>
    </div>
  </div>
@endsection