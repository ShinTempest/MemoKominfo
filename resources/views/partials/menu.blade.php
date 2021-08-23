<div class="sidebar" >
    <nav class="sidebar-nav light">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("home") }}" class="nav-link">
                    <i class="nav-icon fas fa-home">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            {{-- Kelola Anggota --}}
            @can('user_access')
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-user nav-icon">

                        </i>
                        {{ trans('Kelola Anggota') }}
                    </a>
                </li>
            @endcan
            {{-- Pelaporan Berita --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('pelaporan') || request()->is('pelaporan/*') ? 'active' : '' }}" href="{{ route('user.pelaporan.index')}}">
                <i class="fa-fw fas fa-clipboard nav-icon"></i>
                    </i>
                    {{trans('Pelaporan Berita')}}
                </a>
            </li>
            {{-- Rekapitulasi --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('rekapitulasi') || request()->is('rekapitulasi/*') ? 'active' : '' }}" href="{{ route('user.rekapitulasi.index')}}"">
                <i class="fa-fw fas fa-chart-line nav-icon"></i>
                    </i>
                    {{trans('Rekapitulasi')}}
                </a>
            </li>
            {{-- Profil --}}
            <li class="nav-item">
                <a  class="nav-link {{ request()->is('profil') || request()->is('profil/*') ? 'active' : '' }}" href="{{ route('user.profil.index')}}"">
                <i class="fa-fw fas fa-user nav-icon"></i>
                    </i>
                    {{trans('Profil')}}
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">
                        
                    </i>
                    {{ trans('Keluar') }}
                </a>
            </li>
        </ul>

    </nav>
    <!-- <button class="sidebar-minimizer" type="button"></button> -->
</div>