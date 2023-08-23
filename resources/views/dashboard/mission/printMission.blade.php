<!DOCTYPE html>
<html>

<head>
    <title>User Pdf</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="w-100 text-center"><img src="https://www.exen.ma/images/Logo.png" alt="" width="200px"></div>

    <h1 class="mt-5">Mission details</h1>
    <p>{{ $date }}</p>

    <p><strong>Name:</strong> {{ $mission->name }}</p>
    <p>Object: {{ $mission->object }}</p>
    <p>Employee: null</p>
    <p>Description: {{ $mission->description }}</p>
    <p>Place: {{ $mission->place }}</p>
    <div class="row">
        <div class="col-4">
            <p>Date: {{ $mission->date }}</p>
        </div>
        <div class="col-4">
            <p>Start date: {{ $mission->start_date }}</p>
        </div>
        <div class="col-4">
            <p>End date: {{ $mission->end_date }}</p>
        </div>
    </div>
</body>

</html>
