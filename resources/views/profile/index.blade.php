@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

    <div class="row">
      <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Detail Profil</h5>
          <!-- Account -->
          <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="name" class="form-label">Nama</label>
                  <input class="form-control" type="text" id="name" name="name" value="{{ Auth::user()->name }}"/>
                </div>
                <div class="mb-3 col-md-12">
                    <label for="username" class="form-label">Username</label>
                    <input class="form-control" type="text" id="username" name="username" value="{{ Auth::user()->username }}"/>
                </div>
                <div class="mb-3 col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="email" id="email" name="email" value="{{ Auth::user()->email }}"/>
                </div>
                <div class="mb-3 col-md-12">
                  <label class="form-label" for="country">Jabatan</label>
                  <select id="country" class="select2 form-select">
                    <option value="">Pilih Jabatan</option>
                    <option value="0">Developer</option>
                    <option value="1">Area Bussiness Developer</option>
                  </select>
                </div>
              </div>
              <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
              </div>
            </form>
          </div>
          <!-- /Account -->
        </div>

        <div class="card mb-4">
            <h5 class="card-header">Ubah Password</h5>
            <!-- Account -->
            <div class="card-body">
              <form method="POST" action="{{ route('password.update') }}">
                  @csrf
                  @method('PUT')
                <div class="row">
                  <div class="mb-3 col-md-12">
                    <label for="current_password" class="form-label">Password Sekarang</label>
                    <input class="form-control" type="password" id="current_password" name="current_password"/>
                  </div>
                  <div class="mb-3 col-md-12">
                      <label for="password" class="form-label">Password Baru</label>
                      <input class="form-control" type="password" id="password" name="password"/>
                  </div>
                  <div class="mb-3 col-md-12">
                      <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                      <input class="form-control" type="password" id="password_confirmation" name="password_confirmation"/>
                  </div>
                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">Save changes</button>
                  <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
              </form>
            </div>
            <!-- /Account -->
          </div>
        
        <div class="card">
          <h5 class="card-header">Delete Account</h5>
          <div class="card-body">
            <div class="mb-3 col-12 mb-0">
              <div class="alert alert-warning">
                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
              </div>
            </div>
            <form id="formAccountDeactivation" onsubmit="return false">
              <div class="form-check mb-3">
                <input
                  class="form-check-input"
                  type="checkbox"
                  name="accountActivation"
                  id="accountActivation"
                />
                <label class="form-check-label" for="accountActivation"
                  >I confirm my account deactivation</label
                >
              </div>
              <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection