@foreach ($users as $user)
    <div class="modal fade" id="userEditModal{{ $user->id }}" tabindex="-1"
        aria-labelledby="userDetailModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDetailModalLabel{{ $user->id }}">User Edit
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('dashboard.user.update', $user->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="form-user">
                            <label for="name">First Name:</label>
                            <input type="text" class="form-control" name="fname" required
                                value="{{ $user->fname }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Last Name:</label>
                            <input type="text" class="form-control" name="lname" required
                                value="{{ $user->lname }}">
                        </div>

                        <div class="form-user">
                            <label for="name">CIN:</label>
                            <input type="text" class="form-control" name="CIN" required
                                value="{{ $user->CIN }}">
                        </div>

                        <div class="form-user">
                            <label for="name">E-mail:</label>
                            <input type="email" class="form-control" name="email" required
                                value="{{ $user->email }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Profile:</label>
                            <input type="text" class="form-control" name="profile" required
                                value="{{ $user->profile }}">
                        </div>

                        <div class="form-user">
                            <label for="name">Group ID:</label>

                            <select name="group_id" class="form-control" required>
                                <option value="" selected disabled>Select Group ID</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}"
                                        @if ($user->group_id == $group->id) selected @endif>
                                        {{ $group->id }} - {{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>

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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Edit</button>
                        <button type="button" class="btn btn-danger"
                            data-bs-target="#resetPasswordModal{{ $user->id }}" data-bs-toggle="modal">Reset
                            Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Add second modal to reset password --}}
    <div class="modal fade" id="resetPasswordModal{{ $user->id }}" tabindex="-1"
        aria-labelledby="resetPasswordModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel{{ $user->id }}">{{ $user->email }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('dashboard.user.changePassword', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <h3>Reset Password</h3>
                        <label>New Password:</label>
                        <input type="password" class="form-control" name="passwords" required>

                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" name="password_confirmation" required>

                        <span class="text-danger mt-3" id="password-match"></span>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                function checkPasswordMatch() {
                                    var password = document.getElementsByName("passwords")[0].value;
                                    var confirmPassword = document.getElementsByName("password_confirmation")[0].value;
                                    var errorElement = document.getElementById("password-match");

                                    if (password == confirmPassword) {
                                        errorElement.innerHTML = "";
                                    } else {
                                        errorElement.innerHTML = "Passwords do not match";
                                    }
                                }
                                document.getElementsByName("password_confirmation")[0].addEventListener("input", checkPasswordMatch);
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
@endforeach
