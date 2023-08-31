@extends('client.layout')

@section('content')
    <h1 class="text-center m-5">Account</h1>

    <form action="{{ route('client.updateInfo') }}" method="post" class="pb-5">
        @csrf
        @method('PUT')
        <div class="row gy-3">
            <div class="col-md-6">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" name="fname" id="fname" class="form-control" value="{{ $user->fname }}">
            </div>
            <div class="col-md-6">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" name="lname" id="lname" class="form-control" value="{{ $user->lname }}">
            </div>
        </div>
        <div class="row mt-3 gy-3">
            <div class="col-md-6">
                <label for="CIN" class="form-label">CIN</label>
                <input type="text" name="CIN" id="CIN" class="form-control" value="{{ $user->CIN }}">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}">
            </div>
        </div>
        <div class="row mt-3 gy-3">
            <div class="col-md-6">
                <label for="profile" class="form-label">Profile</label>
                <input type="text" name="profile" id="profile" class="form-control" value="{{ $user->profile }}">
            </div>
            <div class="col-md-6">
                <label for="group_id" class="form-label">Group Id</label>
                {{-- Drop down contains groups ids --}}
                <select name="group_id" id="group_id" class="form-select">
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" @if ($group->id == $user->group_id) selected @endif>
                            {{ $group->id }}-{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button class="btn btn-success mt-5 ms-3 float-end" type="submit">Update</button>
        <button type="button" class="btn btn-danger mt-5 float-end" data-bs-toggle="modal"
            data-bs-target="#userChangePassword">
            Change Password
        </button>
    </form>

    {{-- Change Password Modal --}}

    <div class="modal fade" id="userChangePassword" tabindex="-1" aria-labelledby="userChangePasswordLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userChangePasswordLabel">Change Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('client.updatePassword') }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" name="newPassword" id="newPassword" class="form-control">

                        <label for="confirmPassword" class="form-label mt-3">Confirm Password</label>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">

                        <span class="text-danger mt-3" id="password-match"></span>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                function checkPasswordMatch() {
                                    var password = document.getElementById("newPassword").value;
                                    var confirmPassword = document.getElementById("confirmPassword").value;
                                    var errorElement = document.getElementById("password-match");

                                    if (password == confirmPassword) {
                                        errorElement.innerHTML = "";
                                        document.getElementById("submitButton").disabled = false;
                                    } else {
                                        errorElement.innerHTML = "Passwords do not match";
                                        document.getElementById("submitButton").disabled = true;
                                    }
                                }
                                document.getElementById("confirmPassword").addEventListener("input", checkPasswordMatch);
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="submitButton" disabled>Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
