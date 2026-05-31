
<main class="edit-main">
    <h1>Edytuj but</h1>

    <form class="edit-form" action="{{ route('admin.shoes.update', $shoe) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.shoes.form', ['shoe' => $shoe])

        <button>Zapisz zmiany</button>
        <a href="{{ route('admin.shoes.index') }}">Anuluj</a>
    </form>
</main>