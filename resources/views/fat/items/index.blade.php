@extends('layouts.app')

@section('content')
<style>
    table.table-bordered {
        border-collapse: collapse !important;
        width: 100%;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    table.table-bordered th,
    table.table-bordered td {
        border: 2px solid #000 !important;
        padding: 8px;
    }

    table.table-bordered thead th {
        background-color: #f8f9fa;
        font-weight: bold;
        font-size: 1.1rem;
    }
</style>

<div class="py-5" style="background-color: #f0f2f5;"> 
    <div class="container">
        {{-- DAFTAR ITEM USER --}}
        <div class="p-4 mb-5 bg-white shadow rounded border">
            <h2 class="mb-4">Daftar Item FAT</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Item</th>
                        <th>INC</th>
                        <th>Item Type</th>
                        <th>Deskripsi</th>
                        <th>COA</th>
                        <th>GL</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>{{ $item->item_code }}</td>
                        <td>{{ $item->inc }}</td>
                        <td>{{ $item->item_type }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->coa }}</td>
                        <td>{{ $item->gl }}</td>
                        <td>
                            @if($item->status == 0)
                                <span class="badge bg-info">Draft</span>
                            @elseif($item->status == 1)
                                <span class="badge bg-warning text-dark">Di-review FAT</span>
                            @elseif($item->status == 2)
                                <span class="badge bg-primary">Di-review Procurement</span>
                            @elseif($item->status == 3)
                                <span class="badge bg-success">Di-review Logistik</span>
                            @elseif($item->status == 4)
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-secondary">Selesai</span>
                            @endif
                        </td>
                        <td>
                            @if($item->status == 1)
                                <a href="{{ route('fat.items.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('fat.items.submit', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary">Submit ke Procurement</button>
                                </form>
                            @else
                                <span class="text-muted">Tidak ada aksi</span>
                            @endif
                            {{-- Tombol Hapus tetap ditampilkan untuk semua status --}}
                            <form action="{{ route('fat.items.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin hapus item ini?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada item.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div> 

        {{-- DAFTAR GUEST DAN ITEM YANG MEREKA PILIH --}}
        <div class="p-4 bg-white shadow rounded border">
            <h3 class="mb-4 fw-bold fs-4">Daftar Guest dan Item yang Dipilih</h3>

            @forelse($guests as $guest)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-light fw-bold">
                        {{ $guest->name }} ({{ $guest->email }})
                    </div>
                    <div class="card-body">
                        @if($guest->selectedItems->isEmpty())
                            <p class="text-muted">Belum memilih item.</p>
                        @else
                            <ul class="list-group">
                                @foreach($guest->selectedItems as $item)
                                    <li class="list-group-item">
                                        <strong>{{ $item->item_code }}</strong> - {{ $item->description }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-muted">Tidak ada guest yang terdaftar.</p>
            @endforelse
        </div>

    </div>
</div>
@endsection
