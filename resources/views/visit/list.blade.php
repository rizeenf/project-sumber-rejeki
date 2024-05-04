@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <form action="{{ route('visit.search-list', $type) }}" method="GET" class="input-group input-group-merge">
        <input type="hidden" value="{{ $type }}" name="type">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <input type="text" class="form-control" placeholder="Cari..." aria-label="Cari..." aria-describedby="basic-addon-search31" name="search">
      </form>
      @if ($type == 'S')
        <a href="{{ route('visit.list', 'O') }}" class="btn btn-primary mt-2 col-md-12">Campaign Gerai</a>
      @else
        <a href="{{ route('visit.list', 'S') }}" class="btn btn-secondary mt-2 col-md-12">Kunjungan Toko</a>
      @endif
          <div class="row">
          @if($customers->isEmpty())
            <a href="{{ route('dashboard') }}"><img class="responsive" src="{{ asset('custom-icons/Chef-page-not-found.png') }}" alt="" height="1000px"></a>
          @endif
          <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            
            @if(!empty($customers))
              @foreach ($customers as $customer)
              <div class="col">
                <div class="card h-100">
                  <img class="card-img-top" src="{{ asset($customer->photo) }}" alt="{{ $customer->code.' - '.$customer->name }}">
                  <div class="card-body">
                    <h5 class="card-title">{{ $customer->code." - ".$customer->name }}</h5>
                    <p class="card-text">
                      {!! empty($customer->address) ? '<span class="badge bg-label-danger">Alamat Belum Diketahui</span>' : Str::words($customer->address, 10, '. . . ')!!}<br>
                      {{ $customer->area.' - '.$customer->subarea }}
                    </p>
                    @if (!empty($customer->LA) && !empty($customer->LA))
                      <a href="https://maps.google.com/?q={{ $customer->LA.','.$customer->LO }}" class="btn btn-secondary mt-2" target="_blank">Menuju Lokasi</a>
                    @endif
                    <a href="{{ route('visit.create', $customer->id) }}" class="btn btn-primary mt-2">Mulai Kunjungan</a>
                  </div>
                </div>
              </div>
              @endforeach
            @endif
          </div>

          </div>
          <div class="d-flex">
            {!! $customers->links() !!}
          </div>

    </div>
    <!-- / Content -->

    

    <div class="content-backdrop fade"></div>
</div>
@endsection