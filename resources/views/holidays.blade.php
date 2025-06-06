<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Święta w Polsce 2025</title>
</head>
<body>
    <h1>📅 Święta w Polsce 2025</h1>

    @if(count($holidays) > 0)
        <ul>
            @foreach ($holidays as $holiday)
                <li><strong>{{ $holiday['date'] }}</strong> – {{ $holiday['localName'] }}</li>
            @endforeach
        </ul>
    @else
        <p>Brak danych o świętach lub błąd połączenia z API.</p>
    @endif
</body>
</html>
