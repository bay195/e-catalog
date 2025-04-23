@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Item</h2>

    <div class="card shadow-lg rounded">
        <div class="card-body">
            <form action="{{ route('fat.items.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="item_code" class="form-label">Kode Item</label>
                    <input type="text" class="form-control" id="item_code" value="{{ $item->item_code }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="description" value="{{ $item->description }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="coa" class="form-label">COA</label>
                    <input type="text" name="coa" id="coa" class="form-control" value="{{ $item->coa }}">
                </div>

                <div class="mb-3">
                    <label for="gl" class="form-label">GL</label>
                    <input type="text" name="gl" id="gl" class="form-control" value="{{ $item->gl }}">
                </div>

                <button type="submit" class="btn btn-primary w-100">Update Item</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    body {
        background-color: #f4f6f9; /* Light neutral background */
    }

    .card {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: bold;
    }

    .container {
        max-width: 600px;
    }

    .form-control {
        border-color: #ccc;
    }

    .form-label {
        font-weight: bold;
        color: #333;
    }

    .card-body {
        padding: 2rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    /* For Accessibility: High Contrast on Focus */
    .form-control:focus {
        border-color: #0056b3;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    }

    .btn-primary:focus {
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
    }
</style>
@endpush
