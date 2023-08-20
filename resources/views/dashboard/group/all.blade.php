<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Percentage</th>
            <th>Members</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($groups as $group)
            <tr>
                <td class="p-3">{{ $group->id }}</td>
                <td class="p-3">{{ $group->name }}</td>
                <td class="p-3">{{ $group->percentage }} %</td>
                <td class="p-3">
                    @foreach ($group->users as $user)
                        <span class="me-2">{{ $user->fname }} {{ $user->lname }},</span>
                    @endforeach
                </td>
                <td class="d-flex">
                    {{-- Group detail button --}}
                    <button class="btn btn-sm fs-4 text-info" data-bs-toggle="modal"
                        data-bs-target="#groupDetailModal{{ $group->id }}">
                        <i class="fa-solid fa-circle-info"></i>
                    </button>

                    {{-- Edit Group --}}
                    <button class="btn btn-sm fs-4 text-success" data-bs-toggle="modal"
                        data-bs-target="#groupEditModal{{ $group->id }}">
                        <i class="fa-solid fa-edit"></i>
                    </button>

                    {{-- Delete Group --}}
                    <a href="{{ route('dashboard.group.destroy', $group->id) }}"
                        class="fs-4 text-danger fa-solid fa-trash-can pt-2 mt-1 ms-2" data-confirm-delete="true"></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-5">
    {{ $groups->links() }}
</div>
