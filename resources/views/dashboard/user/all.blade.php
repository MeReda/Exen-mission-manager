<table class="table">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>CIN</th>
            <th>Email</th>
            <th>Missions</th>
            <th>Profile</th>
            <th>Group</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="p-3">{{ $user->fname }}</td>
                <td class="p-3">{{ $user->lname }}</td>
                <td class="p-3">{{ $user->CIN }}</td>
                <td class="p-3">{{ $user->email }}</td>
                <td class="p-3">{{ $user->missions->count() }}</td>
                <td class="p-3">{{ $user->profile }}</td>

                {{-- show group if exists --}}
                @if ($user->group)
                    <td class="p-3">{{ $user->group->name }}</td>
                @else
                    <td class="p-3">No group</td>
                @endif

                <td class="d-flex">
                    {{-- User detail button --}}
                    <button class="btn btn-sm fs-4 text-info" data-bs-toggle="modal"
                        data-bs-target="#userDetailModal{{ $user->id }}">
                        <i class="fa-solid fa-circle-info"></i>
                    </button>

                    {{-- Edit Group --}}
                    <button class="btn btn-sm fs-4 text-success" data-bs-toggle="modal"
                        data-bs-target="#userEditModal{{ $user->id }}" data-bs-backdrop="static">
                        <i class="fa-solid fa-edit"></i>
                    </button>

                    {{-- Delete User --}}
                    <a href="{{ route('dashboard.user.destroy', $user->id) }}"
                        class="fs-4 text-danger fa-solid fa-trash-can pt-2 mt-1 ms-2" data-confirm-delete="true"></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-5">
    {{ $users->links() }}
</div>
