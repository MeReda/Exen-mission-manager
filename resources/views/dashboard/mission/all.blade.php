<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Object</th>
            <th>Place</th>
            <th>Date</th>
            <th>Duration</th>
            <th>Employee</th>
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
                <td class="p-3 text-nowrap">{{ $mission->date }}</td>
                <td class="p-3">{{ $start_date->diffInDays($end_date) }}&nbsp;days</td>
                <td class="p-3">{{ $mission->user->fname }} {{ $mission->user->lname }}</td>
                <td class="p-3">
                    @if ($mission->budget)
                        {{ $mission->budget }}&nbsp;DH
                    @else
                        not defined
                    @endif
                </td>
                <td class="text-center ">
                    <div class="d-flex mx-1">

                        {{-- Mission detail button --}}
                        <button class="btn btn-sm fs-4 text-info" data-bs-toggle="modal"
                            data-bs-target="#missionDetailModal{{ $mission->id }}">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>

                        {{-- Print Mission state --}}
                        <button class="btn btn-sm fs-4" data-bs-toggle="modal"
                            data-bs-target="#missionPrint{{ $mission->id }}" data-bs-backdrop="static">
                            <i class="fa-solid fa-print"></i>
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
                                <button type="submit" class="my-tooltip btn btn-sm fs-4 text-warning"
                                    data-bs-placement="top" title="Make mission done">
                                    <i class="fa-solid fa-circle-check"></i>
                                </button>
                            </form>
                        @elseif ($mission->state == 'complete')
                            {{-- show approvement expenses --}}
                            <button class="my-tooltip btn btn-sm fs-4 text-success" data-bs-toggle="modal"
                                data-bs-target="#missionApprove{{ $mission->id }}" data-bs-backdrop="static"
                                data-bs-placement="top" title="Approve Reimbursement">
                                <i class="fa-solid fa-circle-check"></i>
                            </button>
                        @elseif ($mission->state == 'approved')
                            {{-- Done mission (@method('PATCH')) --}}
                            <button class="my-tooltip btn btn-sm fs-4 text-secondary border-0" data-bs-placement="top"
                                title="Mission done and Reimbursement approved">
                                <i class="fa-solid fa-circle-check"></i>
                            </button>
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

{{-- bootstrap tooltip script --}}
<script>
    const tooltips = document.querySelectorAll('.my-tooltip')
    tooltips.forEach(element => {
        new bootstrap.Tooltip(element)
    });
</script>
