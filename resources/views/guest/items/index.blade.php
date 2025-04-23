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
        padding: 12px;
        vertical-align: top;
    }

    table.table-bordered thead th {
        background-color: #e9ecef;
        text-align: center;
    }

    .btn-pilih {
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
    <h2 class="mb-4">Daftar Produk Tersedia</h2>

    @if($items->count())
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Item</th>
                    <th>Denotation</th>
                    <th>INC</th>
                    <th>Item Type</th>
                    <th>UOM</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->item_code }}</td>
                    <td>{{ $item->denotation }}</td>
                    <td>{{ $item->inc }}</td>
                    <td>{{ $item->item_type }}</td>
                    <td>{{ $item->uom }}</td>
                    <td>{{ $item->description }}</td>
                    <td class="btn-pilih">
                        <form action="{{ route('guest.items.select', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Pilih</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="no-data">Belum ada item yang tersedia.</div>
    @endif

    <div class="mt-4">
        <a href="{{ route('guest.items.selected') }}" class="btn btn-success">Lihat Item yang Dipilih</a>
    </div>
</div>
@endsection
