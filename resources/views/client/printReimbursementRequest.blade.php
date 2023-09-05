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

    <p><strong>Mission Name:</strong> {{ $mission->name }}</p>
    <p><strong>Object:</strong> {{ $mission->object }}</p>


    @if ($mission->expenses->isNotEmpty())
        <h2 class="mt-5">Expenses</h2>
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

        {{-- show user group bonus percentage --}}
        <p><strong>Bonus Percentage: </strong> {{ $mission->user->group->percentage }} %</p>
    @else
        {{-- show mission total days count --}}
        @php
            $start_date = Carbon\Carbon::parse($mission->start_date);
            $end_date = Carbon\Carbon::parse($mission->end_date);
            
            $totalDays = $end_date->diffInDays($start_date);
        @endphp
        <p><strong>Mission total days: </strong> {{ $totalDays }} days</p>

        {{-- show user group daily allowance --}}
        <p><strong>Daily Allowance: </strong> {{ $mission->user->group->daily_allowance }} DH</p>


    @endif
    {{-- show total reimbursement --}}
    <p><strong>Total Reimbursement: </strong> {{ $mission->total_reimbursement }} DH</p>


    <p class="mt-5"><strong>Signature:</strong> {{ $mission->user->fname }} {{ $mission->user->lname }}</p>

</body>

</html>
