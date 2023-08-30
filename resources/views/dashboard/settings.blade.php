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
                    <input type="password" class="form-control" id="verifyAdminPassword" name="password_confirmation"
                        required>

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
