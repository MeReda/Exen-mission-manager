<!DOCTYPE html>
<html>

<head>
    <title>Mission Info</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="w-100 text-center"><img src="https://www.exen.ma/images/Logo.png" alt="" width="200px"></div>

    <h1 class="mt-5">Mission Order</h1>
    <p>{{ $date }}</p>

    <p><strong>Name:</strong> {{ $mission->name }}</p>
    <p><strong>Object:</strong> {{ $mission->object }}</p>
    <p><strong>Employee:</strong> {{ $mission->user->fname }} {{ $mission->user->lname }}</p>
    <p><strong>Description:</strong> {{ $mission->description }}</p>
    <p><strong>Place:</strong> {{ $mission->place }}</p>
    <div class="row">
        <div class="col-4">
            <p><strong>Date:</strong> {{ $mission->date }}</p>
        </div>
        <div class="col-4">
            <p><strong>Start date:</strong> {{ $mission->start_date }}</p>
        </div>
        <div class="col-4">
            <p><strong>End date:</strong> {{ $mission->end_date }}</p>
        </div>
    </div>

    <p><strong>Signature:</strong> {{ $admin->fname }} {{ $admin->lname }}</p>
</body>

</html>
