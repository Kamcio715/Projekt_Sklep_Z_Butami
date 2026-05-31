@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-create.css') }}">
<main class="admin-create">
    <h1>Dodaj but</h1>

    <form class="create-from" action="{{ route('admin.shoes.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.shoes.form')

        <button>Zapisz</button>
        <a href="{{ route('admin.shoes.index') }}">Anuluj</a>
    </form>
</main>
    @endsection
