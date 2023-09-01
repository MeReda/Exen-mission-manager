@foreach ($missions as $mission)
    <div class="modal fade" id="missionDetailModal{{ $mission->id }}" tabindex="-1"
        aria-labelledby="missionDetailModalLabel{{ $mission->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="missionDetailModalLabel{{ $mission->id }}">{{ $mission->name }} Details
                    </h5>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> {{ $mission->id }}</p>
                    <p><strong>Name:</strong> {{ $mission->name }}</p>
                    <p><strong>Employee:</strong> {{ $mission->user->fname }} {{ $mission->user->lname }}</p>
                    <p><strong>Object:</strong> {{ $mission->object }}</p>
                    <p><strong>Description:</strong> {{ $mission->description }}</p>
                    <p><strong>Place:</strong> {{ $mission->place }}</p>
                    <p><strong>Date:</strong> {{ $mission->date }}</p>
                    <p><strong>Start Date:</strong> {{ $mission->start_date }}</p>
                    <p><strong>End Date:</strong> {{ $mission->end_date }}</p>
                    <p><strong>Companion:</strong>
                        @if ($mission->companion != null)
                            {{ $mission->companion }}
                        @else
                            not defined
                        @endif
                    </p>
                    <p><strong>Budget: </strong>
                        @if ($mission->budget)
                            {{ $mission->budget }} DH
                        @else
                            not defined
                        @endif
                    </p>
                    <p><strong>State:</strong> {{ $mission->state }}</p>

                    @if ($mission->total_reimbursement != null)
                        <p><strong>Total Reimbursement:</strong> {{ $mission->total_reimbursement }} DH</p>
                    @endif

                    <p><strong>Comment: </strong>
                        @if ($mission->comment != null)
                            {{ $mission->comment }}
                        @else
                            No comment
                        @endif
                    </p>
                    @if ($mission->expenses->count() != 0)
                        <p>
                            <strong>Expenses: </strong>
                            <button type="button" class="btn btn-sm btn-info text-white ms-2" data-bs-toggle="modal"
                                data-bs-target="#missionExpensesModal">
                                Show Expenses
                            </button>
                        </p>
                    @endif

                    <p><strong>Reimbursement State:</strong> {{ $mission->reimbursement_state }}</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Mission Expenses Modal --}}
    <div class="modal fade" id="missionExpensesModal" tabindex="-1" aria-labelledby="missionExpensesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="missionExpensesModalLabel">Mission Expenses</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-4 fw-bold">Category</div>
                        <div class="col-4 fw-bold">Amount</div>
                        <div class="col-4 fw-bold">Receipt</div>
                    </div>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($mission->expenses as $expense)
                        <div class="row mt-3">
                            <div class="col-4">{{ $expense->category }}</div>
                            <div class="col-4">{{ $expense->amount }} DH</div>
                            <div class="col-4">
                                <a href="{{ asset($expense->receipt_image) }}" target="_blank">
                                    <img src="{{ asset($expense->receipt_image) }}" alt="Receipt" width="100px">
                                </a>
                            </div>
                        </div>
                        @php
                            $total += $expense->amount;
                        @endphp
                    @endforeach

                    {{-- Show Expenses Total --}}
                    <div class="row mt-5 align-items-center">
                        <div class="col-4"><strong>Total: </strong></div>

                        <div class="col">{{ $total }} DH</div>
                    </div>

                    {{-- Show group percentage --}}
                    @if ($mission->user->group != null)
                        <div class="row mt-5 align-items-center">
                            <div class="col-4"><strong>Group percentage: </strong></div>
                            <div class="col">{{ $mission->user->group->percentage }} %</div>
                        </div>
                    @endif

                    {{-- Show Expenses Comment --}}
                    <div class="row mt-5 align-items-center">
                        <div class="col-4"><strong>Comment:</strong></div>
                        <div class="col">
                            @if ($mission->comment != null)
                                {{ $mission->comment }}
                            @else
                                No comment
                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
