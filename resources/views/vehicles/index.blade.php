<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


      <script src="{{ asset('js/app.js')}}"></script>
        <!-- Styles -->
        <style>
        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
      <div id="app">
        <transport-units :vehicles=""> True </transport-units>
        <!-- <transport-units :vehicles="{{ json_encode($vehicles) }}">  </transport-units> -->
      </div>
    </body>
</html>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Vehicles</title>
</head>
<body>
    <h1>Vehicles</h1>

    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Name</th>
                <th>Model</th>
                <th>Length</th>
                <th>Width</th>
                <th>Load Capacity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $key => $vehicle)
                <tr>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->name }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->length }}</td>
                    <td>{{ $vehicle->width }}</td>
                    <td>{{ $vehicle->load_capacity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> -->