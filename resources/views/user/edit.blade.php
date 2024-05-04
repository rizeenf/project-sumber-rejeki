@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> --}}

    <div class="row">
      <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Data Pengguna</h5>
          <!-- Form -->
          <div class="card-body">
            <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="name" class="form-label">Nama</label>
                  <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="username" class="form-label">Username</label>
                  <input class="form-control" type="text" id="username" name="username" value="{{ $user->username }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="email" class="form-label">Email</label>
                  <input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="password" class="form-label">Password</label>
                  <input class="form-control" type="password" id="password" name="password"/>
                </div>
                
                <div class="mb-3 col-md-12">
                  <label for="password" class="form-label">Konfirmasi Password</label>
                  <input class="form-control" type="password" id="password_confirmation" name="password_confirmation"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label class="form-label" for="sub-brand">Posisi/Jabatan</label>
                  <select id="position" class="select2 form-select" name="position">
                    <option value="0">Pilih Jabatan</option>
                    @foreach ($positions as $position)
                      <option value="{{ $position->id }}" {{ $position->id == $user->position_id ? 'selected' : ''}}>{{ $position->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-3 col-md-12">
                  <label class="form-label" for="sub-brand">Grup Akses</label>
                  <select id="position" class="select2 form-select" name="access">
                    <option value="0">Pilih Grup Akses</option>
                    @foreach ($roles as $role)
                      <option value="{{ $role }}" {{ $role == $user->getRoleNames() ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                  </select>
                </div>

              </div>
              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Kembali</a>
              </div>
            </form>
          </div>
          <!-- /Form -->
        </div>
      </div>

    </div>
  </div>
@endsection