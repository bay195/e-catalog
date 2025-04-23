@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Item</h2>

    <form action="{{ route('procurement.items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="unit_price">Unit Price</label>
            <input type="text" name="unit_price" id="unit_price" class="form-control" value="{{ old('unit_price', $item->unit_price) }}" required>
        </div>

        <div class="form-group">
            <label for="main_supplier">Main Supplier</label>
            <input type="text" name="main_supplier" id="main_supplier" class="form-control" value="{{ old('main_supplier', $item->main_supplier) }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
