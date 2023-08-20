<div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('dashboard.user.store') }}">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">First Name:</label>
                        <input type="text" class="form-control" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Last Name:</label>
                        <input type="text" class="form-control" name="lname" required>
                    </div>
                    <div class="form-group">
                        <label for="name">CIN:</label>
                        <input type="text" class="form-control" name="CIN" required>
                    </div>
                    <div class="form-group">
                        <label for="name">E-mail:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Profile:</label>
                        <input type="text" class="form-control" name="profile" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Group Id:</label>
                        <input type="number" class="form-control" name="group_id" required>
                    </div>

                    {{-- Show errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li class="m-0">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Group</button>
                </div>
            </form>
        </div>
    </div>
</div>
