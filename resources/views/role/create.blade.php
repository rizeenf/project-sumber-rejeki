@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> --}}

    <div class="row">
      <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Tambah Akses Grup</h5>
          <!-- Form -->
          <div class="card-body">
            <form method="POST" action="{{ route('role.store') }}">
                @csrf
              <div class="row">
                <div class="mb-3 col-md-12">
                    <label for="name" class="form-label">Nama</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}"/>
                </div>
              </div>
              <div class="mt-2">
                {{-- <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('category.index') }}" class="btn btn-outline-secondary">Kembali</a> --}}
              </div>
            {{-- </form> --}}
          </div>
          <!-- /Form -->
        </div>

      </div>

      <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Pengaturan Akses Grup</h5>
          <!-- Form -->
          <div class="card-body">
            {{-- <form method="POST" action="{{ route('role.store') }}"> --}}
                <div class="card">
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr class="text-nowrap">
                          <th>#</th>
                          <th>Modul</th>
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
                        @php
                          $no = 1;
                          $arr = 0;
                        @endphp
                        @foreach ($moduls as $modul)
                          <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ ucfirst($modul->name) }}</td>
                            <td>
                              @if ($modul->view == 0)

                              @else
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="{{ $modul->name }} view" id="view" name="view[{{ $arr }}]">
                                </div>
                              @endif
                            </td>
                            <td>
                              @if ($modul->detail == 0)

                              @else
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="{{ $modul->name }} detail" id="detail" name="detail[{{ $arr }}]">
                                </div>
                              @endif
                            </td>
                            <td>
                              @if ($modul->create == 0)

                              @else
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="{{ $modul->name }} create" id="create" name="create[{{ $arr }}]">
                                </div>
                              @endif
                            </td>
                            <td>
                              @if ($modul->edit == 0)

                              @else
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="{{ $modul->name }} edit" id="edit" name="edit[{{ $arr }}]">
                                </div>
                              @endif
                            </td>
                            <td>
                              @if ($modul->delete == 0)

                              @else
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="{{ $modul->name }} delete" id="delete" name="delete[{{ $arr }}]">
                                </div>
                              @endif
                            </td>
                            <td>
                              @if ($modul->export == 0)

                              @else
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="{{ $modul->name }} export" id="export" name="export[{{ $arr }}]">
                                </div>
                              @endif
                            </td>
                            <td>
                              @if ($modul->import == 0)

                              @else
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="{{ $modul->name }} import" id="import" name="import[{{ $arr }}]">
                                </div>
                              @endif
                            </td>
                          </tr>
                          @php
                            $arr++
                          @endphp
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>

              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('role.index') }}" class="btn btn-outline-secondary">Kembali</a>
              </div>
            </form>
          </div>
          <!-- /Form -->
        </div>

      </div>
    </div>
  </div>
@endsection