
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{ route('dashboard') }}" class="app-brand-link">
        <span class="app-brand-text demo text fw-bolder ms-2">Sumber rejeki</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item active">
        <a href="{{ route('dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      
        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Data</span>
        </li>
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-dock-top"></i>
            <div data-i18n="">Master Data</div>
          </a>
          <ul class="menu-sub">
              <li class="menu-item">
                <a href="{{ route('branch.index') }}" class="menu-link">
                  <div data-i18n="Account">Cabang</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('position.index') }}" class="menu-link">
                  <div data-i18n="Account">Jabatan</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('display.index') }}" class="menu-link">
                  <div data-i18n="Account">Display Produk</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('category.index') }}" class="menu-link">
                  <div data-i18n="Account">Kategori Produk</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('brand.index') }}" class="menu-link">
                  <div data-i18n="Account">Brand Produk</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('sub-brand.index') }}" class="menu-link">
                  <div data-i18n="Account">Sub Brand Produk</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('product.index') }}" class="menu-link">
                  <div data-i18n="Account">Produk</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('store.index') }}" class="menu-link">
                  <div data-i18n="Account">Toko</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('outlet.index') }}" class="menu-link">
                  <div data-i18n="Account">Gerai</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('unproductive-reason.index') }}" class="menu-link">
                  <div data-i18n="Account">Alasan Tidak Produktif</div>
                </a>
              </li>
          </ul>
        </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Laporan</span>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="">Kunjungan</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('visit.summary') }}" class="menu-link">
              <div data-i18n="Account">Summary Kunjungan Karyawan</div>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{ route('galery.index') }}" class="menu-link">
              <div data-i18n="Account">Summary Galery Foto</div>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{ route('report-unproductive') }}" class="menu-link">
              <div data-i18n="Account">Kunjungan Tidak Produktif</div>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{ route('report-gift') }}" class="menu-link">
              <div data-i18n="Account">Pengeluaran Hadiah/Sampel</div>
            </a>
          </li>

        </ul>
      </li>

        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Pengaturan</span>
        </li>
        <li class="menu-item">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-dock-top"></i>
            <div data-i18n="Account Settings">Website</div>
          </a>
          <ul class="menu-sub">
              <li class="menu-item">
                <a href="{{ route('user.index') }}" class="menu-link">
                  <div data-i18n="Account">Pengguna</div>
                </a>
              </li>

              <li class="menu-item">
                <a href="{{ route('role.index') }}" class="menu-link">
                  <div data-i18n="Account">Grup Akses</div>
                </a>
              </li>

              <li class="menu-item">
                <a href="{{ route('modul.index') }}" class="menu-link">
                  <div data-i18n="Account">Modul</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('log-activity.index') }}" class="menu-link">
                  <div data-i18n="Account">Log Aktivitas</div>
                </a>
              </li>
            {{-- <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Account">Main Menu</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Account">Menu</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="" class="menu-link">
                <div data-i18n="Account">Sub Menu</div>
              </a>
            </li> --}}

          </ul>
        </li>
      
    </ul>

    {{-- <ul class="menu-inner py-1">
    </ul> --}}
      

      {{-- PARENT MAIN MENU--}}
      {{-- <li class="menu-item active">
        <a href="{{ route('dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li> --}}

      {{-- PARENT MENU --}}
      {{-- <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Data</span>
      </li> --}}

      {{-- SUB MENU --}}
      {{-- <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="">Master Data</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="{{ route('branch.index') }}" class="menu-link">
              <div data-i18n="Account">Cabang</div>
            </a>
          </li>

        </ul>

      </li> --}}
  </aside>