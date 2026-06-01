<link rel="stylesheet" href="{{ asset('css/user-edit.css') }}">
@extends('layouts.app')

@section('content')
<div class="user-edit">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h1 class="h3 mb-4">Dane użytkownika</h1>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Imię</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Adres</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                            @error('address')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telefon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        @if (!$user->hasVerifiedEmail())
                            <div class="alert alert-warning">
                                Ten adres e-mail nie jest zweryfikowany.
                            </div>
                        @endif

                        <button type="submit" class="btn btn-dark btn-save">Zapisz zmiany</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection