<!DOCTYPE html>
<html>
<head>
    <title>About Page</title>
</head>
<body>
    <h1>About Page</h1>
    <p>Name: {{ $name }}</p>
    <p>Age: {{ $age }}</p>

    <h3>Hobbies:</h3>
    <ul>
        @foreach($hobbies as $hobby)
            <li>{{ $hobby }}</li>
        @endforeach
    </ul>
</body>
</html>
