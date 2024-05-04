@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4> --}}

    <div class="row">
      <div class="col-md-6">

        <div class="card mb-4">
          <h5 class="card-header">Data Kunjungan Umum</h5>
          <!-- Form -->
          <div class="card-body">
            <form method="POST" action="{{ route('visit.store', $generalVisit->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $customer->id }}" name="id_customer">
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="code" class="form-label">Kode {{ $customer->type == 'S' ? 'Toko' : 'Gerai' }}</label>
                  <input class="form-control" type="text" id="code" name="code" value="{{ $customer->code }}" readonly/>
                </div>

                <div class="mb-3 col-md-12">
                    <label for="name" class="form-label">Nama</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ $customer->name }}" readonly/>
                </div>
                <input class="form-control" type="hidden" id="lat" name="lat" value="{{ old('lat') }}" readonly/>
                <input class="form-control" type="hidden" id="lon" name="lon" value="{{ old('lon') }}" readonly/>

                <div class="mb-3 col-md-12">
                  <label for="name" class="form-label">Foto Kunjungan</label>
                  <input class="form-control" type="file" id="photo_visit" name="photo_visit" aaccept="image/*" capture="camera"/ required>
                </div>

                @if ($customer->type == 'S')
                <div class="col-md-12 mb-2">
                  <label class="text-light fw-semibold d-block">Spanduk</label>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" id="banner" value="1" name="banner">
                    <label class="form-check-label" for="inlineRadio1">Terpasang</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="banner" value="0" name="banner" required>
                    <label class="form-check-label" for="inlineRadio2">Tidak ada</label>
                  </div>
                </div>
                
                <div class="col-md-12 mb-2">
                  <label class="text-light fw-semibold d-block">Aktifitas</label>
                  <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" id="activity" value="Visit" name="activity" required>
                    <label class="form-check-label" for="inlineRadio1">Kunjungan</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="activity" value="Maintenance" name="activity">
                    <label class="form-check-label" for="inlineRadio2">Maintenance Display</label>
                  </div>
                </div>
                @else
                  <input type="hidden" value="0" name="banner">
                  <input type="hidden" value="Visit" name="activity">
                @endif

                <div class="mb-3 col-md-12">
                  <label for="note" class="form-label">Catatan Kunjungan</label>
                  <textarea name="note" rows="2" class="form-control">{{ old('note') }}</textarea>
                </div>
                
              </div>
              {{-- <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('visit.list', 'S') }}" class="btn btn-outline-secondary">Kembali</a>
              </div>
            </form> --}}
          </div>
          <!-- /Form -->
        </div>

      </div>


      @if ($customer->type == 'S')
        <div class="col-md-6">

          <div class="card mb-4">
            <h5 class="card-header">Data Display Toko</h5>
            <!-- Form -->
            <div class="card-body">
                <div class="row">
                  <div class="mb-3 col-md-12">
                    <label for="code" class="form-label">Display Produk</label>
                    <select name="display[]" id="display" class="form-control" multiple="multiple"></select>
                  </div>

                  <div class="mb-3 col-md-12">
                    <label for="code" class="form-label">Kategori Produk</label>
                    <select name="category[]" id="category" class="form-control" multiple="multiple"></select>
                  </div>

                  <div class="mb-3 col-md-12">
                    <label for="brand" class="form-label">Produk yang tersedia</label>
                    <select name="brand[]" id="brand" class="form-control" multiple="multiple"></select>
                  </div>

                  <div class="mb-3 col-md-12">
                    <label for="name" class="form-label">Foto Display</label>
                    <input class="form-control" type="file" id="photo_display" name="photo_display" accept="image/*" capture="camera"/>
                  </div>

                  <div class="col-md-12 mb-2">
                    <label class="text-light fw-semibold d-block">Alasan tidak pasang display</label>
                    @foreach ($reasons as $reason)
                      <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="checkbox" id="reason[]" value="{{ $reason->id }}" name="reason[]">
                        <label class="form-check-label" for="inlineCheckbox1">{{ ucfirst($reason->name) }}</label>
                      </div>
                    @endforeach
                    <div class="input-group mt-2">
                      <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" name="other_reason" id="other_reason">
                      </div>
                      <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Alasan lainnya" name="name_other_reason">
                    </div>
                  </div>
                  
                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">Simpan</button>
                  <a href="{{ route('visit.list', 'S') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
              </form>
            </div>
            <!-- /Form -->
          </div>

        </div>
      @else
        <div class="col-md-6">

          <div class="card mb-4">
            <h5 class="card-header">Data Gerai</h5>
            <!-- Form -->
            <div class="card-body">
                <div class="row">
                  <div class="col-md-12 mb-2">
                    <label class="text-light fw-semibold d-block">Sudah Pakai Produk Hansel?</label>
                    <div class="form-check form-check-inline mt-3">
                      <input class="form-check-input" type="radio" id="status" value="Y" name="status">
                      <label class="form-check-label" for="inlineRadio1">Sudah</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="status" value="M" name="status">
                      <label class="form-check-label" for="inlineRadio2">Sudah, Tetapi Pakai Produk Lain Juga</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="status" value="N" name="status" required>
                      <label class="form-check-label" for="inlineRadio2">Belum Sama Sekali</label>
                    </div>
                  </div>
                  <hr>

                  <label for="" class="form-label">Produk yang Dipakai Gerai</label>
                  <div id="TextBoxesGroup">
                    <div id="TextBoxDiv1">
                      <div class="mb-3 col-md-12">
                        <label for="usedProduct" class="form-label">Nama/Kode Produk</label>
                        <select class="form-control" name="usedProduct[]" id="product1" multiple required></select>
                      </div>
    
                      <div class="mb-3 col-md-12">
                        <label for="purchaseAmount" class="form-label">Harga Beli</label>
                        <input type="text" class="form-control" name="purchaseAmount" id="purchaseAmount1">
                      </div>
                    </div><br>
                  </div>
                
                  <hr>
                  {{-- <input type="button" class="btn btn-primary mb-2 col-md-3" id="addButton" value="Tambah Produk">&nbsp;
                  <input type="button" class="btn btn-secondary mb-2 col-md-3" id="removeButton" value="Hapus Produk">&nbsp;
                  <input type="button" class="btn btn-secondary mb-2 col-md-3" id="getButtonValue" value="Tes Value Produk"> --}}

                  <div class="mb-3 col-md-12">
                    <label for="store" class="form-label">Toko Beli yang Sudah Register</label>
                    <select name="store" id="store" class="form-control"></select>
                  </div>

                  {{-- <div class="mb-3 col-md-12">
                    <label for="name" class="form-label">Foto Display</label>
                    <input class="form-control" type="file" id="photo_display" name="photo_display" accept="image/*" capture="camera"/>
                  </div> --}}

                  <div class="mb-3 col-md-12">
                    <label for="store_name" class="form-label">Nama Toko Beli</label>
                    <input class="form-control" type="text" id="store_name" name="store_name" value="{{ old('store_name') }}"/>
                  </div>

                  <div class="mb-3 col-md-12">
                    <label for="market_name" class="form-label">Pasar Beli</label>
                    <input class="form-control" type="text" id="market_name" name="market_name" value="{{ old('market_name') }}"/>
                  </div>

                  <div class="mb-3 col-md-12">
                    <label for="mark" class="form-label">Patokan Toko Beli</label>
                    <textarea name="mark" id="mark" rows="3" class="form-control">{{ old('mark') }}</textarea>
                  </div>

                  <div class="col-md-12 mb-2">
                    <label class="text-light fw-semibold d-block">Alasan Pakai Produk/Belum Pakai Produk</label>
                    @foreach ($reasons as $reason)
                      <div class="form-check form-check-inline mt-3">
                        <input class="form-check-input" type="checkbox" id="reason[]" value="{{ $reason->id }}" name="reason[]">
                        <label class="form-check-label" for="inlineCheckbox1">{{ ucfirst($reason->name) }}</label>
                      </div>
                    @endforeach
                    <div class="input-group mt-2">
                      <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" name="other_reason" id="other_reason">
                      </div>
                      <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Alasan lainnya" name="name_other_reason">
                    </div>
                  </div>

                  <div class="mb-3 col-md-12">
                    <label for="sales_amount" class="form-label">Qty Penjualan Perhari</label>
                    <input class="form-control" type="number" id="sales_amount" name="sales_amount" value="{{ old('sales_amount') }}" multiple required/>
                  </div>

                  <label for="" class="form-label">Sampel Produk yang Diberikan ke Gerai</label>
                      <div class="mb-3 col-md-12">
                        <label for="usedProduct" class="form-label">Nama/Kode Produk</label>
                        <select class="form-control" name="sample[]" id="sample" multiple required></select>
                      </div>
    
                      <div class="mb-3 col-md-12">
                        <label for="purchaseAmount" class="form-label">Jumlah Produk</label>
                        <input type="text" class="form-control" name="qty_sample" id="qty_sample">
                      </div>

                      <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">Foto Penyerahan Sampel</label>
                        <input class="form-control" type="file" id="photo_sample" name="photo_sample" accept="image/*" capture="camera"/ required>
                      </div>
                    <br>
                  
                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">Simpan</button>
                  <a href="{{ route('visit.list', 'O') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
              </form>
            </div>
            <!-- /Form -->
          </div>

        </div>
      @endif
      
    </div>
  </div>
@endsection

@push('geolocation')
  <script>
    getLocation();
    function showPosition(position) {
        document.getElementById('lat').value = position.coords.latitude;
        document.getElementById('lon').value = position.coords.longitude;
      }
  </script>
@endpush

@push('select2')
  <script type="text/javascript">
  $(document).ready(function(){
    var displayPath = "{{ route('display.autocomplete') }}";
    var categoryPath = "{{ route('category.autocomplete') }}";
    var brandPath = "{{ route('brand.autocomplete') }}";
    var storePath = "{{ route('store.autocomplete') }}";
    var productPath = "{{ route('product.autocomplete') }}";
    var counter = 2;
  
    $('#display').select2({
        placeholder: 'Pilih display produk',
        ajax: {
          url: displayPath,
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
    });

    $('#category').select2({
        placeholder: '--Pilih kategori produk--',
        ajax: {
          url: categoryPath,
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
    });

    $('#brand').select2({
        placeholder: '--Pilih brand produk yang tersedia di toko--',
        ajax: {
          url: brandPath,
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
    });

    $('#store').select2({
        placeholder: '--Pilih toko yang sudah register--',
        theme: 'form-control',
        ajax: {
          url: storePath,
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.name + ' - ' + item.address,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
    });

    $('#product1').select2({
        placeholder: '--Pilih produk--',
        ajax: {
        url: productPath,
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.name,
                id: item.id
              }
            })
          };
        },
        cache: true
        }
    });

    $('#sample').select2({
        placeholder: '--Pilih produk--',
        ajax: {
        url: productPath,
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.code+' - '+item.name,
                id: item.id
              }
            })
          };
        },
        cache: true
        }
    });

    $("#addButton").click(function () {
                    
      var newTextBoxDiv = $(document.createElement('div'))
        .attr("id", 'TextBoxDiv' + counter);
                                
      newTextBoxDiv.after().html(
          '<div class="mb-3 col-md-12">'+
            '<label for="product" class="form-label">Nama/Kode Produk</label>'+
            '<select class="form-control" name="usedProduct[]" id="product'+counter+'"></select>'+
          '</div>'+
    
          '<div class="mb-3 col-md-12">'+
            '<label for="purchaseAmount" class="form-label">Harga Beli</label>'+
            '<input type="number" class="form-control" name="purchaseAmount[]" id="purchaseAmount'+counter+'">'+
          '</div><br>'
        )
                            
                            
      newTextBoxDiv.appendTo("#TextBoxesGroup");

      $('#product'+counter).select2({
        placeholder: 'Pilih produk',
        ajax: {
        url: productPath,
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
              return {
                text: item.code+' - '+item.name,
                id: item.id
              }
            })
          };
        },
        cache: true
        }
      });
      counter++;
    });

    $("#removeButton").click(function () {
      if(counter==1){
        alert("Tidak ada textfield lagi");
          return false;
      }   
                    
      counter--;
                        
      $("#TextBoxDiv" + counter).remove();
                        
      });
                    
      $("#getButtonValue").click(function () {
        var msg = '';
        for(i=1; i<counter; i++){
          msg += "\n Textbox #product" + i + " : " + $('#product' + i).val();
          msg += "\n Textbox #purchaseAmount" + i + " : " + $('#purchaseAmount' + i).val();
          // msg += "\n Textbox name usedProduct : "+$("input[name='usedProduct[]']").val();
          // msg += "\n Textbox name purchaseAmount : "+$("input[name='purchaseAmount[]']").val();
        }
        alert(msg);
    });
  });
  </script>
@endpush
