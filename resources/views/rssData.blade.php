<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Rss Feed for bank.lv">
    <meta name="keywords" content="Rss, Feed, MVC">
    <meta name="author" content="Vadims Gurinovics">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
</head>
<body>

<div class="container">
    <h1>{{$title}}</h1>
    <table>
        <thead>
        <tr>
            <th>Valsts Kods</th>
            <th>Valūtas vienības par 1 eiro</th>
            <th>Publicēšanas Datums</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->country_code }}</td>
                <td>{{ $item->unit_value }}</td>
                <td>{{ $item->pub_date }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>
</body>
</html>
