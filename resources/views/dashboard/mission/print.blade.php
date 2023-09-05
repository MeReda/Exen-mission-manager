@foreach ($missions as $mission)
    <div class="modal fade" id="missionPrint{{ $mission->id }}" tabindex="-1"
        aria-labelledby="missionPrintModalLabel{{ $mission->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="missionPrintModalLabel{{ $mission->id }}">Print Mission Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a href="{{ route('dashboard.mission.printMission', $mission->id) }}" class="btn btn-secondary">
                        Print mission details
                    </a>
                    @if ($mission->state == 'approved')
                        <a href="{{ route('dashboard.mission.printReimbursement', $mission->id) }}"
                            class="btn btn-secondary">
                            Print reimbursement request
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- If state = approved will add button to print reimbursement request --}}
