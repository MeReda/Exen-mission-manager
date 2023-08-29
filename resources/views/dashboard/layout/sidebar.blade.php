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
                <li><button class="dropdown-item" type="button" data-bs-toggle="modal"
                        data-bs-target="#accountSettingsModal">Account</button></li>
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

{{-- Account Settings Modal --}}

<div class="modal fade" id="accountSettingsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Account info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.user.update', $admin->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input class="form-control" name="fname" type="text" value="{{ $admin->fname }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="lname">Last Name</label>
                        <input class="form-control" name="lname" type="text" value="{{ $admin->lname }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="lname">E-mail</label>
                        <input class="form-control" name='email' type="email" value="{{ $admin->email }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>

                    <button type="button" class="btn btn-danger" data-bs-target="#changeAdminPasswordModal"
                        data-bs-toggle="modal">
                        Chage Password
                    </button>


                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="changeAdminPasswordModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Change Admin Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.user.changePassword', $admin->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <h3>Reset Password</h3>
                    <label>New Password:</label>
                    <input type="password" class="form-control" id="adminPassword" name="passwords" required>

                    <label>Confirm Password:</label>
                    <input type="password" class="form-control" id="verifyAdminPassword"
                        name="password_confirmation" required>

                    <span class="text-danger mt-3" id="admin-password-match"></span>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            function checkPasswordMatch() {
                                var password = document.getElementById("adminPassword").value;
                                var confirmPassword = document.getElementById("verifyAdminPassword").value;
                                var errorElement = document.getElementById("admin-password-match");

                                if (password == confirmPassword) {
                                    errorElement.innerHTML = "";
                                } else {
                                    errorElement.innerHTML = "Passwords do not match";
                                }
                            }
                            document.getElementById("verifyAdminPassword").addEventListener("input", checkPasswordMatch);
                        });
                    </script>

                    {{-- Show errors --}}
                    @if ($errors->any())
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: '{{ $errors->first() }}'
                            });
                        </script>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
