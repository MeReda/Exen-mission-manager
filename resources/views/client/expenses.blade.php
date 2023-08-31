<h2 class="text-center m-5">Expenses</h2>
<div class="expenses bg-white p-3 my-5 w-100">

    @if ($mission->state == 'incomplete')
        <button type="button" class="btn btn-success float-end mb-3" data-bs-toggle="modal"
            data-bs-target="#addExpenseModal">
            Add Expense
        </button>
    @endif

    <table class="table align-items-center text-center">
        <thead>
            <tr>
                <th>Category</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Receipt</th>
                @if ($mission->state == 'incomplete')
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($mission->expenses as $expense)
                <tr>
                    <td>{{ $expense->category }}</td>
                    <td>{{ $expense->amount }} DH</td>
                    <td>{{ $expense->description }}</td>
                    <td>
                        <a href="{{ asset($expense->receipt_image) }}" target="_blank">
                            <img src="{{ asset($expense->receipt_image) }}" alt="Receipt" width="100px">
                        </a>
                    </td>
                    <td>
                        @if ($mission->state == 'incomplete')
                            <form action="{{ route('client.destroyExpense', $expense->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endif
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
            <form action="{{ route('client.storeExpense') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="name" name="category" required>
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
