@foreach ($missions as $mission)
    <div class="modal fade" id="missionApprove{{ $mission->id }}" tabindex="-1"
        aria-labelledby="missionApproveLabel{{ $mission->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="missionApproveLabel{{ $mission->id }}">Approve Mission Reimbursement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dashboard.mission.approve', $mission->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body p-5">
                        {{-- Show Expenses infos --}}
                        @if ($mission->expenses != [])
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
                                            <img src="{{ asset($expense->receipt_image) }}" alt="Receipt"
                                                width="100px">
                                        </a>
                                    </div>
                                </div>
                                @php
                                    $total += $expense->amount;
                                @endphp
                            @endforeach
                        @else
                            <p>No expenses</p>
                        @endif

                        {{-- Show group percentage --}}
                        @if ($mission->user->group != null)
                            <div class="row mt-5 align-items-center">
                                <div class="col-3"><strong>Group percentage: </strong></div>
                                <div class="col-2">{{ $mission->user->group->percentage }} %</div>
                            </div>

                            {{-- Show Expenses Total --}}
                            <div class="row mt-5 align-items-center">
                                <div class="col-2"><strong>Total: </strong></div>

                                <div class="col-2"><input type="number" class="form-control"
                                        name="total_reimbursement"
                                        value="{{ $total + ($mission->user->group->percentage / 100) * $total }}"
                                        required>
                                </div>
                                <div class="col-1">DH</div>
                            </div>
                        @endif

                        {{-- Show Expenses Comment --}}
                        <div class="row mt-5 align-items-center">
                            <div class="col-2"><strong>Comment:</strong></div>
                            <div class="col">
                                <input type="text" class="form-control" name="comment"
                                    placeholder="Your comment to explain if you change the total amount">
                            </div>
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
                        <button type="submit" class="btn btn-success">Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
