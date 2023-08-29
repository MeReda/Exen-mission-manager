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
                        {{-- disable auto complete --}}

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
                        <select name="group_id" class="form-control" required>
                            <option value="" selected disabled>Select Group Id</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->id }} - {{ $group->name }}</option>
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
                    <button type="submit" class="btn btn-success">Add Group</button>
                </div>
            </form>
        </div>
    </div>
</div>
