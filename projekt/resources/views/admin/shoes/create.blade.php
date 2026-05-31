@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-create.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<main class="admin-create">
    <h1>Dodaj but</h1>

    <form class="create-from" action="{{ route('admin.shoes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.shoes.form')

        <button type="submit">Zapisz</button>
        <a href="{{ route('admin.shoes.index') }}">Anuluj</a>
    </form>
</main>
    @endsection
