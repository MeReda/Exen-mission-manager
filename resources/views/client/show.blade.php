@extends('client.layout')

@section('content')
    <h1 class="text-center m-5">Mission info</h1>

    <div class="bg-white p-3">
        <p><strong>ID:</strong> {{ $mission->id }}</p>
        <p><strong>Name:</strong> {{ $mission->name }}</p>
        <p><strong>Employee:</strong> {{ $mission->user->fname }} {{ $mission->user->lname }}</p>
        <p><strong>Object:</strong> {{ $mission->object }}</p>
        <p><strong>Description:</strong> {{ $mission->description }}</p>
        <p><strong>Place:</strong> {{ $mission->place }}</p>
        <p><strong>Date:</strong> {{ $mission->date }}</p>
        <p><strong>Start Date:</strong> {{ $mission->start_date }}</p>
        <p><strong>End Date:</strong> {{ $mission->end_date }}</p>
        <p><strong>Companion:</strong> {{ $mission->companion }}</p>
        <p><strong>Budget:</strong> {{ $mission->budget }} DH</p>
        <p><strong>State:</strong> {{ $mission->state }}</p>
        @if ($mission->total_reimbursement != null)
            <p><strong>Total Reimbursement:</strong> {{ $mission->total_reimbursement }} DH</p>
        @endif
        @if ($mission->comment != null)
            <p><strong>Comment:</strong> {{ $mission->comment }}</p>
        @endif
    </div>

    <h2 class="text-center m-5">Expenses</h2>
    <div class="expenses bg-white p-3 my-5 w-100">
        @if ($mission->state == 'incomplete')
            <button type="button" class="btn btn-success float-end mb-3" data-bs-toggle="modal"
                data-bs-target="#addExpenseModal">
                Add Expense
            </button>
        @endif
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Receipt</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mission->expenses as $expense)
                    <tr class="d-flex justify-content-between">
                        <td>{{ $expense->name }}</td>
                        <td>{{ $expense->amount }} DH</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No expenses</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addExpenseModalLabel">Add Expense</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('client.storeExpense') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Category</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <div class="mb-3">
                            <label for="receipt" class="form-label">Receipt</label>
                            <input type="file" class="form-control" id="receipt" name="receipt" required>
                        </div>

                        <input type="text" name="mission_id" value="{{ $mission->id }}" hidden>

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
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
