<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin-form.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    @csrf

    <div class="mb-3">
        <label class="form-label">Nazwa</label>
        <input placeholder="Airmax" type="text" name="name" value="{{ old('name', $shoe->name ?? '') }}"
            class="form-control @error('name') is-invalid @enderror">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Marka</label>
        <input placeholder="Addidas" type="text" name="brand" value="{{ old('brand', $shoe->brand ?? '') }}"
            class="form-control @error('brand') is-invalid @enderror">
        @error('brand')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Kategoria</label>
        <select name="category" class="form-select">
            <option value="">Wybierz</option>
            <option value="Dla mężczyzn" @selected(old('category', $shoe->category ?? '') == 'Dla mężczyzn')>Dla mężczyzn</option>
            <option value="Dla kobiet" @selected(old('category', $shoe->category ?? '') == 'Dla kobiet')>Dla kobiet</option>
            <option value="Dla dzieci" @selected(old('category', $shoe->category ?? '') == 'Dla dzieci')>Dla dzieci</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Rodzaj</label>
        <select name="type" class="form-select">
            <option value="">Wybierz</option>
            <option value="Sportowe" @selected(old('type', $shoe->type ?? '') == 'Sportowe')>Sportowe</option>
            <option value="Eleganckie" @selected(old('type', $shoe->type ?? '') == 'Eleganckie')>Eleganckie</option>
            <option value="Codzienne" @selected(old('type', $shoe->type ?? '') == 'Codzienne')>Codzienne</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Rozmiar</label>
        <input placeholder="42" type="number" step="0.5" name="size" value="{{ old('size', $shoe->size ?? '') }}"
            class="form-control @error('size') is-invalid @enderror">
        @error('size')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Cena</label>
        <input placeholder="200.00" type="number" step="0.01" name="price" value="{{ old('price', $shoe->price ?? '') }}"
            class="form-control @error('price') is-invalid @enderror">
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Kolor</label>
        <input placeholder="czerwony" type="text" name="color" value="{{ old('color', $shoe->color ?? '') }}"
            class="form-control @error('color') is-invalid @enderror">
        @error('color')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Opis</label>
        <textarea placeholder="Super nowe buty" name="description" rows="4"
                class="form-control @error('description') is-invalid @enderror">{{ old('description', $shoe->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Ilość na stanie</label>
        <input placeholder="2137" type="number" name="stock" value="{{ old('stock', $shoe->stock ?? '') }}"
            class="form-control @error('stock') is-invalid @enderror">
        @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Zdjęcie</label>
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if(!empty($shoe?->image))
            <div class="mt-3 image-preview">
                <img src="{{ asset('storage/' . $shoe->image) }}"
                    alt="{{ $shoe->name }}"
                    style="width: 150px; height: 150px; object-fit: cover;"
                    class="rounded">
            </div>
        @endif
    </div>
</body>
</html>