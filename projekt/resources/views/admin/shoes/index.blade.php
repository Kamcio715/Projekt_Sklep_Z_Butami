<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="admin-header">
        <h1 class="mb-0">Panel admina - buty</h1>
        <a href="{{ route('admin.shoes.create') }}" class="btn btn-warning">Dodaj but</a>
    </div>

    @if($shoes->count() === 0)
        <p>Brak produktów.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered bg-white">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Zdjęcie</th>
                        <th>Nazwa</th>
                        <th>Marka</th>
                        <th>Rozmiar</th>
                        <th>Cena</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shoes as $shoe)
                        <tr>
                            <td>{{ $shoe->id }}</td>
                            <td>
                                @if($shoe->image)
                                    <img src="{{ asset('storage/' . $shoe->image) }}"
                                        alt="{{ $shoe->name }}"
                                        style="width: 80px; height: 80px; object-fit: cover;"
                                        class="rounded">
                                @else
                                    Brak
                                @endif
                            </td>
                            <td>{{ $shoe->name }}</td>
                            <td>{{ $shoe->brand }}</td>
                            <td>{{ $shoe->size }}</td>
                            <td>{{ number_format($shoe->price, 2, ',', ' ') }} zł</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('shoes.show', $shoe) }}" class="btn btn-sm btn-outline-secondary">Podgląd</a>
                                <a href="{{ route('admin.shoes.edit', $shoe) }}" class="btn btn-sm btn-primary">Edytuj</a>

                                <form action="{{ route('admin.shoes.destroy', $shoe) }}" method="POST" onsubmit="return confirm('Na pewno usunąć?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $shoes->links() }}
    @endif
    @endsection

</body>
</html>