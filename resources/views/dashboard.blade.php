@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        
          <div class="row">

            <div class="col-lg-3 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="{{ asset('template/assets/img/icons/unicons/chart-success.png') }}"
                        alt="chart success"
                        class="rounded"/>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Jumlah Toko</span>
                  <h3 class="card-title mb-2">{{ $store }}</h3>
                  {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="{{ asset('template/assets/img/icons/unicons/chart-success.png') }}"
                        alt="chart success"
                        class="rounded"/>
                    </div>
                  </div>
                  <span>Gerai</span>
                  <h3 class="card-title text-nowrap mb-1">{{ $outlet }}</h3>
                  {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="{{ asset('template/assets/img/icons/unicons/chart-success.png') }}"
                        alt="chart success"
                        class="rounded"/>
                    </div>
                    
                  </div>
                  <span>Pengguna</span>
                  <h3 class="card-title text-nowrap mb-1">{{ $user }}</h3>
                  {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img src="{{ asset('template/assets/img/icons/unicons/chart-success.png') }}"
                        alt="chart success"
                        class="rounded"/>
                      </div>
                      
                    </div>
                    <span>Kunjungan</span>
                    <h3 class="card-title text-nowrap mb-1">{{ $visit }}</h3>
                    {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> --}}
                  </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-12 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Mulai Kunjungan Toko</h5>
                  <a href="{{ route('visit.list', 'S') }}" class="btn btn-primary">Menuju Daftar Toko</a>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-12 col-12 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Mulai Kunjungan Gerai</h5>
                  <a href="{{ route('visit.list', 'O') }}" class="btn btn-secondary">Menuju Daftar Gerai</a>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Grafik Kunjungan</h5>

                  {!! $chartvisit->container() !!}
                  
                </div>
              </div>
            </div>

            <!-- <div class="col-lg-6 col-md-6 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Market Share</h5>

                  {!! $chartmarketshare->container() !!}
                  
                </div>
              </div>
            </div> -->

          </div>

    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>
@endsection

@push('chart')
  <script src="{{ $chartvisit->cdn() }}"></script>
  <script src="{{ $chartmarketshare->cdn() }}"></script>
  <script src="{{ $chartincrement->cdn() }}"></script>
  <script src="{{ $chartmonthlydisplay->cdn() }}"></script>

  {{ $chartvisit->script() }}
  {{ $chartmarketshare->script() }}
  {{ $chartincrement->script() }}
  {{ $chartmonthlydisplay->script() }}
@endpush