@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Item</h2>

    <form action="{{ route('user.items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label>Kode Item</label>
            <input type="text" name="item_code" class="form-control" value="{{ old('item_code', $item->item_code) }}">
        </div>

        <div class="mb-3">
            <label>INC</label>
            <input type="text" name="inc" class="form-control" value="{{ old('inc', $item->inc) }}">
        </div>

        <div class="mb-3">
            <label>Item Type</label>
            <input type="text" name="item_type" class="form-control" value="{{ old('item_type', $item->item_type) }}">
        </div>

        <div class="mb-3">
            <label>Item Group</label>
            <input type="text" name="item_group" class="form-control" value="{{ old('item_group', $item->item_group) }}">
        </div>

        <div class="mb-3">
            <label>UOM</label>
            <input type="text" name="uom" class="form-control" value="{{ old('uom', $item->uom) }}">
        </div>

        <div class="mb-3">
            <label>Denotation</label>
            <input type="text" name="denotation" class="form-control" value="{{ old('denotation', $item->denotation) }}">
        </div>

        <div class="mb-3">
            <label>Keyword</label>
            <input type="text" name="keyword" class="form-control" value="{{ old('keyword', $item->keyword) }}">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description', $item->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Old Code</label>
            <input type="text" name="old_code" class="form-control" value="{{ old('old_code', $item->old_code) }}">
        </div>

        <div class="mb-3">
            <label>Cross Ref 1</label>
            <input type="text" name="cross_ref_1" class="form-control" value="{{ old('cross_ref_1', $item->cross_ref_1) }}">
        </div>

        <div class="mb-3">
            <label>Cross Ref 2</label>
            <input type="text" name="cross_ref_2" class="form-control" value="{{ old('cross_ref_2', $item->cross_ref_2) }}">
        </div>

        <div class="mb-3">
            <label>Cross Ref 3</label>
            <input type="text" name="cross_ref_3" class="form-control" value="{{ old('cross_ref_3', $item->cross_ref_3) }}">
        </div>

        <div class="mb-3">
            <label>Functional Location</label>
            <input type="text" name="functional_location" class="form-control" value="{{ old('functional_location', $item->functional_location) }}">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>


</div>
@endsection
