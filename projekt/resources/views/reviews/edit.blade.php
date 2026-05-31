@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edytuj opinię</h2>

    <form action="{{ route('reviews.update', $review) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="rating" class="form-label">Ocena</label>
            <select name="rating" id="rating" class="form-control">
                <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5/5</option>
                <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4/5</option>
                <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3/5</option>
                <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2/5</option>
                <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1/5</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Treść opinii</label>
            <textarea name="content" id="content" rows="4" class="form-control">{{ $review->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
    </form>
</div>
@endsection
