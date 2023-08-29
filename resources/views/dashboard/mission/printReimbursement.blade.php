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
            @foreach ($mission->expenses as $expense)
                <tr>
                    <td>{{ $expense->category }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->amount }}&nbsp;DH</td> {{-- I've used the &nbsp to add space to the amount because when I add it using ' ' the DH backs to the line --}}
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total: </strong>{{ $mission->total_reimbursement }} DH</p>
    @if ($mission->comment)
        <p><strong>Comment: </strong> {{ $mission->comment }} </p>
    @endif
</body>

</html>
