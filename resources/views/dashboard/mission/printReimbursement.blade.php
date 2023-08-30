<!DOCTYPE html>
<html lang="en">

<head>
    <title>Print Reimbursement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="w-100 text-center"><img src="https://www.exen.ma/images/Logo.png" alt="" width="200px"></div>

    <h1 class="mt-5">Reimbursement Request</h1>
    <p>{{ $date }}</p>

    <p><strong>Employee:</strong> {{ $mission->user->fname }} {{ $mission->user->lname }}</p>
    <p><strong>Mission Name:</strong> {{ $mission->name }}</p>
    <p><strong>Object:</strong> {{ $mission->object }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalExpenses = 0;
            @endphp
            @foreach ($mission->expenses as $expense)
                <tr>
                    <td>{{ $expense->category }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->amount }}&nbsp;DH</td>
                </tr>
                @php
                    $totalExpenses += $expense->amount;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><strong>Total:</strong></td>
                <td>{{ $totalExpenses }} DH</td>
            </tr>
        </tfoot>
    </table>

    <p><strong>Group bonus: </strong>{{ $mission->user->group->percentage }} %</p>
    <p><strong>Final Total: </strong>{{ $mission->total_reimbursement }} DH</p>
    @if ($mission->comment)
        <p><strong>Comment: </strong> {{ $mission->comment }} </p>
    @endif

    <p class="mt-5"><strong>Signature:</strong> {{ $admin->fname }} {{ $admin->lname }}</p>

</body>

</html>
