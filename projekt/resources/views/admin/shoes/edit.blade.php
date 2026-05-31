<link rel="stylesheet" href="{{ asset('css/admin-edit.css') }}">
@extends('layouts.app')

@section('content')
<main class="edit-main">
    <h1>Edytuj but</h1>

    <form class="edit-form" action="{{ route('admin.shoes.update', $shoe) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.shoes.form', ['shoe' => $shoe])

        <button class="save">Zapisz zmiany</button>
        <a class="save" href="{{ route('admin.shoes.index') }}">Anuluj</a>
    </form>
</main>
@endsection