<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="{{ url('/admin/dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/img/AdminLTELogo.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">RSHP</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">

            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false">

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <a href="{{ url('/admin/dashboard') }}"
                       class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- MASTER DATA -->
                <li class="nav-item">
                  <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-folder-fill"></i>
                      <p>
                          Master Data
                          <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                  </a>

                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('admin.jenis.index') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Jenis Hewan</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('admin.ras.index') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Ras Hewan</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('admin.kategori.index') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Kategori</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('admin.kategori_klinis.index') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Kategori Klinis</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('admin.tindakan_terapi.index') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Kode Tindakan Terapi</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('admin.pet.index') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Pet</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('admin.role.index') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Role</p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ route('admin.user.index') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>User</p>
                          </a>
                      </li>
                  </ul>
              </li>

                <!-- DOCUMENTATION -->
                <li class="nav-header">DOCUMENTATIONS</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-book"></i>
                        <p>Manual Book</p>
                    </a>
                </li>
            </ul>

        </nav>
    </div>
    <!--end::Sidebar Wrapper-->

</aside>
