<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Object</th>
            <th>Place</th>
            <th>Date</th>
            <th>Duration</th>
            <th>Companion</th>
            <th>Budget</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($missions as $mission)
            @php
                $start_date = \Carbon\Carbon::parse($mission->start_date);
                $end_date = \Carbon\Carbon::parse($mission->end_date);
            @endphp
            <tr>
                <td class="p-3">{{ $mission->name }}</td>
                <td class="p-3">{{ $mission->object }}</td>
                <td class="p-3">{{ $mission->place }}</td>
                <td class="p-3">{{ $mission->date }}</td>
                <td class="p-3">{{ $start_date->diffInDays($end_date) }} days</td>
                <td class="p-3">{{ $mission->companion }}</td>
                <td class="p-3">{{ $mission->budget }} DH</td>
                <td class="text-center ">
                    <div class="d-flex mx-1">

                        {{-- Mission detail button --}}
                        <button class="btn btn-sm fs-4 text-info" data-bs-toggle="modal"
                            data-bs-target="#missionDetailModal{{ $mission->id }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>

                        {{-- If the mission is not done can be modified else it will be printed --}}

                        @if ($mission->state == 'incomplete')
                            {{-- Edit Mission --}}
                            <button class="btn btn-sm fs-4 text-success" data-bs-toggle="modal"
                                data-bs-target="#missionEditModal{{ $mission->id }}" data-bs-backdrop="static">
                                <i class="fa-solid fa-edit"></i>
                            </button>

                            {{-- complete mission (@method('PATCH')) --}}
                            <form action="{{ route('dashboard.mission.complete', $mission->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm fs-4 text-warning"><i
                                        class="fa-solid fa-circle-check"></i></button>
                            </form>
                        @elseif ($mission->state == 'complete')
                            {{-- Print Mission state --}}
                            <button class="btn btn-sm fs-4" data-bs-toggle="modal"
                                data-bs-target="#missionPrint{{ $mission->id }}" data-bs-backdrop="static"><i
                                    class="fa-solid fa-print"></i></button>

                            {{-- show approvement expenses --}}
                            <button class="btn btn-sm fs-4 text-success" data-bs-toggle="modal"
                                data-bs-target="#missionApprove{{ $mission->id }}" data-bs-backdrop="static">
                                <i class="fa-solid fa-circle-check"></i>
                            </button>
                        @elseif ($mission->state == 'approved')
                            {{-- Print Mission state and reimbursement request --}}
                            <button class="btn btn-sm fs-4"><i class="fa-solid fa-print"></i></button>

                            {{-- Done mission (@method('PATCH')) --}}
                            <button class="btn btn-sm fs-4 text-secondary border-0" disabled><i
                                    class="fa-solid fa-circle-check"></i></button>
                        @endif


                        {{-- Delete Mission (Archive) --}}
                        <a href="{{ route('dashboard.mission.destroy', $mission->id) }}"
                            class="fs-4 text-danger fa-solid fa-trash-can pt-2 mt-1 ms-2" data-confirm-delete="true">
                        </a>
                    </div>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class=" mt-5">
    {{ $missions->links() }}
</div>
