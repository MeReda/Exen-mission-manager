<!DOCTYPE html>
<html>

<head>
    <title>User Pdf</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="w-100 text-center"><img src="https://www.exen.ma/images/Logo.png" alt="" width="200px"></div>

    <h1 class="mt-5">Employees</h1>
    <p>{{ $date }}</p>

    <table class="table table-bordered w-100 fs-5">
        <thead>
            <tr>
                <th>Name</th>
                <th>CIN</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Group</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr class="fs-5">
                    <td>{{ $user->fname }} {{ $user->lname }}</td>
                    <td>{{ $user->CIN }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->profile }}</td>
                    <td>{{ $user->group->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
