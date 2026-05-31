<main class="admin-create">
    @section('content')
    <h1>Dodaj but</h1>

    <form class="create-from" action="{{ route('admin.shoes.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.shoes.form')

        <button>Zapisz</button>
        <a href="{{ route('admin.shoes.index') }}">Anuluj</a>
    </form>
    @endsection
</main>