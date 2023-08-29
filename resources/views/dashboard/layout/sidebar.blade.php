<div
    class="col-2 col-md-3 col-lg-2 border-end p-5 h-100 d-flex flex-column align-items-between justify-content-between ">
    {{-- should change this shit --}}
    <div>

        {{-- logo --}}
        <img class="img-fluid p-2" src="{{ asset('images/transparetn-logo.png') }}" alt="logo">
        {{-- menu --}}
        <ul class="nav nav-pills flex-column gap-2 mt-5">
            <li
                class="nav-item p-1 px-3 d-flex gap-2 align-items-center rounded sidebar-menu-button {{ $active === 'dashboard' ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i>
                <a href="{{ route('dashboard.index') }}" class="nav-link text-black w-100">Dashboard</a>
            </li>
            <li
                class="nav-item p-1 px-3 d-flex gap-2 align-items-center rounded sidebar-menu-button {{ $active === 'mission' ? 'active' : '' }}">
                <i class="fa-solid fa-list-check"></i>
                <a href="{{ route('dashboard.mission.index') }}" class="nav-link text-black w-100">Missions</a>
            </li>
            <li
                class="nav-item p-1 px-3 d-flex gap-2 align-items-center rounded sidebar-menu-button {{ $active === 'archive' ? 'active' : '' }}">
                <i class="fa-solid fa-archive"></i>
                <a href="{{ route('dashboard.archive.index') }}" class="nav-link text-black w-100">Archive</a>
            </li>
            <li
                class="nav-item p-1 px-3 d-flex gap-2 align-items-center rounded sidebar-menu-button {{ $active === 'group' ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <a href="{{ route('dashboard.group.index') }}" class="nav-link text-black w-100">Groups</a>
            </li>
            <li
                class="nav-item p-1 px-3 d-flex gap-2 align-items-center rounded sidebar-menu-button {{ $active === 'user' ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i>
                <a href="{{ route('dashboard.user.index') }}" class="nav-link text-black w-100">Employees</a>
            </li>
        </ul>
    </div>

    {{-- Account & logout --}}
    <div class="text-black w-100 d-flex justify-content-between align-items-center mb-3 p-3 rounded bg-white">
        <a href="#" class="w-100 text-black text-decoration-none">User Name</a>
        <div class="btn-group">
            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-gear"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><button class="dropdown-item" type="button">Account</button></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
