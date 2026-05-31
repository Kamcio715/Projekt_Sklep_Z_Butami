
<main class="form-main">
    <form class="admin-form" action="{{ route('admin.shoes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- FORM FIELDS --}}
        <input type="text" name="name" placeholder="Nazwa">
        <input type="text" name="brand" placeholder="Marka">
        <input type="number" name="price" placeholder="Cena">

        <button>Zapisz</button>
    </form>
</main>