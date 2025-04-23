@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Lengkapi Data Logistik</h2>

    <form action="{{ route('logistik.items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="storage_location" class="form-label">Storage Location</label>
            <input type="text" name="storage_location" id="storage_location" class="form-control" value="{{ old('storage_location', $item->storage_location) }}">
        </div>

        <div class="mb-3">
            <label for="max_stock_level" class="form-label">Max Stock Level</label>
            <input type="number" name="max_stock_level" id="max_stock_level" class="form-control" value="{{ old('max_stock_level', $item->max_stock_level) }}">
        </div>

        <div class="mb-3">
            <label for="reorder_point" class="form-label">Reorder Point</label>
            <input type="number" name="reorder_point" id="reorder_point" class="form-control" value="{{ old('reorder_point', $item->reorder_point) }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('logistik.items.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection