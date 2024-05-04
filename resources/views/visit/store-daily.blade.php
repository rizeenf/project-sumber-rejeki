@extends('layouts.master')

@section('content')
<!-- Bordered Table -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-2">
        <div class="card-header">
            <div class="row">
                <h5>Summary Kunjungan</h5>
                <div class="card-header-action">
                    {{-- <a href="{{ route('visit.summary') }}" class="btn btn-primary"><box-icon name='plus' ></box-icon> Kembali</a> --}}
                    {{-- <a href="{{ route('category.trashed') }}" class="btn btn-secondary"><box-icon name='plus' ></box-icon> Data Terhapus</a> --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Nama Staff</label>
                    <input class="form-control" type="text" value="{{ $headerVisit->user_name }}" readonly/>
                </div>
                
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Tanggal Kunjungan</label>
                    <input class="form-control" type="text" value="{{ $headerVisit->date }}" readonly/>
                </div>

                {{-- <div class="card">
                    <div class="card-body">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.8675027205927!2d106.71173127498972!3d-6.14849119383857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f91ecf5f35bb%3A0x72211d95c2d53367!2sPT.%20Gavi%20Unggul%20Niaga%20Adika!5e0!3m2!1sid!2sid!4v1710976009104!5m2!1sid!2sid"
                        width="530" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div> --}}
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Mulai Kunjungan</label>
                    <input class="form-control" type="text" value="{{ $headerVisit->min_time_in }}" readonly/>
                </div>
                
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Selesai Kunjungan</label>
                    <input class="form-control" type="text" value="{{ $headerVisit->max_time_out }}" readonly/>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Toko Terkunjungi</label>
                    <input class="form-control" type="text" value="{{ $headerVisit->store_visit }}" readonly/>
                </div>
                
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Gerai Terkunjungi</label>
                    <input class="form-control" type="text" value="{{ $headerVisit->outlet_visit }}" readonly/>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Target Kunjungan</label>
                    <input class="form-control" type="text" value="0" readonly/>
                </div>
                
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Total Kunjungan</label>
                    <input class="form-control" type="text" value="{{ $headerVisit->total_visit }}" readonly/>
                </div>
            </div>
            <a href="{{ route('visit.summary') }}" class="btn btn-primary"><box-icon name='plus' ></box-icon> Kembali</a>
            
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <h5>Tabel Toko dan Display</h5>
                <div class="card-header-action">
                    <a href="{{ route('visit.detail-daily', ['date' => $headerVisit->date, 'user' => $headerVisit->user_id]) }}" class="btn btn-primary"><box-icon name='plus' ></box-icon> Semua Kunjungan</a>
                    <a href="{{ route('visit.detail-outlet-daily', ['date' => $headerVisit->date, 'user' => $headerVisit->user_id]) }}" class="btn btn-secondary"><box-icon name='plus' ></box-icon> Campaign Gerai</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
    <!--/ Bordered Table -->
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- The Close Button -->
  <span class="close">&times;</span>
  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">
  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
@endsection

@push('modal_image')
    <script>
        $(document).on('click', '.myImg', function() {
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("img01");
            modal.style.display = "block";
            modalImg.src = this.src;

            var span = document.getElementsByClassName("close")[0];
            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            };
        });
    </script>
@endpush

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush