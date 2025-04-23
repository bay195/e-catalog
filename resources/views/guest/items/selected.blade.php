@extends('layouts.app')

@section('content')
<style>
    table.table-bordered {
        border-collapse: collapse !important;
        width: 100%;
    }

    table.table-bordered th,
    table.table-bordered td {
        border: 2px solid #000 !important;
        padding: 10px;
        vertical-align: middle;
    }

    table.table-bordered thead th {
        background-color: #e9ecef;
        text-align: center;
    }

    .btn-hapus {
        display: flex;
        justify-content: center;
    }

    .no-data {
        text-align: center;
        font-style: italic;
        padding: 20px;
    }
</style>

<div class="container">
    <h2 class="mb-4">Item yang Kamu Pilih</h2>

    @if ($selectedItems->isEmpty())
        <div class="no-data">Belum ada item yang dipilih.</div>
        <a href="{{ route('guest.items.index') }}" class="btn btn-primary mt-3">Kembali</a>
    @else
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Item</th>
                        <th>Denotation</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectedItems as $item)
                    <tr>
                        <td>{{ $item->item_code }}</td>
                        <td>{{ $item->denotation }}</td>
                        <td class="btn-hapus">
                            <form action="{{ route('guest.items.deselect', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('guest.items.index') }}" class="btn btn-primary mt-3">Kembali</a>
    @endif
</div>
@endsection
