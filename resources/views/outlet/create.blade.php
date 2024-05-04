@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> --}}

    <div class="row">
      <div class="col-md-6">

        <div class="card mb-4">
          <h5 class="card-header">Data Toko</h5>
          <!-- Form -->
          <div class="card-body">
            <form method="POST" action="{{ route('outlet.store') }}" enctype="multipart/form-data">
                @csrf
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="code" class="form-label">Kode</label>
                  <input class="form-control" type="text" id="code" name="code" value="{{ old('code') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                    <label for="customer_name" class="form-label">Nama Pelanggan</label>
                    <input class="form-control" type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="customer_phone" class="form-label">No. Telepon Pelanggan</label>
                  <input class="form-control" type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="photo" class="form-label">Foto Pelanggan</label>
                  <input class="form-control" type="file" id="photo" name="photo"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="description" class="form-label">Alamat</label>
                  <textarea name="customer_address" id="customer_address" rows="3" class="form-control">{{ old('customer_address') }}</textarea>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="la" class="form-label">Latitude</label>
                  <input class="form-control" type="number" id="la" name="la" value="{{ old('la') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="lo" class="form-label">Longitude</label>
                  <input class="form-control" type="number" id="lo" name="lo" value="{{ old('lo') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="area" class="form-label">Area</label>
                  <input class="form-control" type="text" id="area" name="area" value="{{ old('area') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="subarea" class="form-label">Sub Area</label>
                  <input class="form-control" type="text" id="subarea" name="subarea" value="{{ old('subarea') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label class="form-label d-block">Status Registrasi</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="regist" id="regist" value="Y" />
                        <label class="form-check-label" for="inlineRadio1">Sudah Menjadi Member</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="regist" id="regist" value="M" />
                      <label class="form-check-label" for="inlineRadio1">Mixing</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="regist" id="regist" value="N" />
                      <label class="form-check-label" for="inlineRadio2">Belum Menjadi Member</label>
                    </div>
                </div>

                <div class="mb-3 col-md-12">
                  <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" value="1" id="banner" name="banner"/>
                    <label class="form-check-label" for="defaultCheck1"> Sudah pasang spanduk </label>
                  </div>
                </div>

                <div class="mb-3 col-md-12">
                  <label class="form-label" for="sub-brand">Cabang</label>
                  <select id="branch" class="select2 form-select" name="branch">
                    <option value="0">Pilih Cabang</option>
                    @foreach ($branches as $branch)
                      <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                  </select>
                </div>

              </div>
              {{-- <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Kembali</a>
              </div> --}}
            {{-- </form> --}}
          </div>
          <!-- /Form -->
        </div>

      </div>

      <div class="col-md-6">

        <div class="card mb-4">
          <h5 class="card-header">Data Pemilik</h5>
          <!-- Form -->
          <div class="card-body">
            {{-- <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data"> --}}
                @csrf
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="owner_name" class="form-label">Nama Pemilik</label>
                  <input class="form-control" type="text" id="owner_name" name="owner_name" value="{{ old('owner_name') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="nik" class="form-label">NIK</label>
                  <input class="form-control" type="text" id="nik" name="nik" value="{{ old('nik') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="owner_phone" class="form-label">No. Telepon Pemilik</label>
                  <input class="form-control" type="text" id="owner_phone" name="owner_phone" value="{{ old('owner_phone') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="owner_address" class="form-label">Alamat Pemilik</label>
                  <textarea name="owner_address" id="owner_address" rows="3" class="form-control">{{ old('owner_address') }}</textarea>
                </div>

              </div>
              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('outlet.index') }}" class="btn btn-outline-secondary">Kembali</a>
              </div>
            </form>
          </div>
          <!-- /Form -->
        </div>

      </div>
    </div>
  </div>
@endsection