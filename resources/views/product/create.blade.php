@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> --}}

    <div class="row">
      <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Tambah Produk</h5>
          <!-- Form -->
          <div class="card-body">
            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="image" class="form-label">Gambar</label>
                  <input class="form-control" type="file" id="image" name="image"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="code" class="form-label">Kode</label>
                  <input class="form-control" type="text" id="code" name="code" value="{{ old('code') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                    <label for="name" class="form-label">Nama</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}"/>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="description" class="form-label">Deskripsi</label>
                  <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3 col-md-12">
                  <label for="competitor" class="form-label">Merupakan Produk Kompetitor</label>
                  <div class="input-group">
                    <div class="input-group-text">
                      <input class="form-check-input mt-0" type="checkbox" value="1" name="competitor"/>
                    </div>
                    <input type="text" class="form-control" name="competitor_name" placeholder="Nama Kompetitor"/>
                  </div>
                </div>

                <div class="mb-3 col-md-12">
                  <label class="form-label" for="category">Kategori Produk</label>
                  <select id="category" class="select2 form-select" name="category">
                    <option value="0">Pilih Kategori Produk</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-3 col-md-12">
                  <label class="form-label" for="brand">Brand Produk</label>
                  <select id="brand" class="select2 form-select" name="brand">
                    <option value="0">Pilih Brand Produk</option>
                    @foreach ($brands as $brand)
                      <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-3 col-md-12">
                  <label class="form-label" for="sub-brand">Sub Brand Produk</label>
                  <select id="sub_brand" class="select2 form-select" name="sub_brand">
                    <option value="0">Pilih Sub Brand Produk</option>
                    @foreach ($subBrands as $subBrand)
                      <option value="{{ $subBrand->id }}">{{ $subBrand->name }}</option>
                    @endforeach
                  </select>
                </div>

              </div>
              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Kembali</a>
              </div>
            </form>
          </div>
          <!-- /Form -->
        </div>

      </div>
    </div>
  </div>
@endsection