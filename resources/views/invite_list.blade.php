<!DOCTYPE html>
<html lang="en">
<head>
    <title>Harish Bhatt(Laravel Developer)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container">
        <h2>Invitation List within 100km.</h2>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>AffiliateId</th>
                    <th>Name</th>
                    <th>Lat, Long</th>
                    <th>Distance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($conents_arr as $key => $value)
                <tr>
                    <td>{{ $value->affiliate_id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->latitude .', '. $value->longitude }}</td>
                    <td>{{ $value->distance }}</td>
                </tr>
                @endforeach
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
