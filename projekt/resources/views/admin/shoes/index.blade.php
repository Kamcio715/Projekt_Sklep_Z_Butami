<main class="admin-main">
    @section('content')

    <h1>Panel admina</h1>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Cena</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shoes as $shoe)
            <tr>
                <td>{{ $shoe->id }}</td>
                <td>{{ $shoe->name }}</td>
                <td>{{ $shoe->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @endsection
</main>