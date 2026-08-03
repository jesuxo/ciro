<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="/dashboard" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="50">
            </span>
        </a>
        <a href=/dashboard" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar" style="background: #f2f2f2;"  >
        <div class="container-fluid" >

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav" >
                <li class="menu-title"><span data-key="t-menu">{{ __('t-menu') }}</span></li>

                @if(Auth::user() and auth()->user()->type == 'admin')

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('dashboard',['tienda'=>'SanCristobal'])}}"  >
                            <i class="bi bi-box-seam"></i> Promos San Cristobal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('dashboard',['tienda'=>'ElVigia'])}}"  >
                            <i class="bi bi-box-seam"></i> Promos El Vigia
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="/iaknowledge"  >
                            <i class="bi bi-robot"></i> Asistente Virtual
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('chat.index') }}"  >
                            <i class="bi bi-envelope"></i> Conversaciones
                        </a>
                    </li>

                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
