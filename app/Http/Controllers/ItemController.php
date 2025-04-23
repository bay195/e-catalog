<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ItemController extends Controller
{
    // =========================
    // Guest
    // =========================
    public function guestIndex()
    {
        $items = Item::where('status', 4)->get(); // hanya yang disetujui logistik;
        return view('guest.items.index', compact('items'));
    }

    public function guestSelectItem($id)
    {
        $item = Item::findOrFail($id);

        if ($item->status !== 4) {
            return redirect()->back()->with('error', 'Item belum disetujui logistik.');
        }

        Auth::user()->selectedItems()->syncWithoutDetaching([$id]);

        return redirect()->back()->with('success', 'Item berhasil dipilih.');
    }

    public function guestSelectedItems()
    {
        $selectedItems = Auth::user()->selectedItems; // atau auth()->user()->selectedItems
        return view('guest.items.selected', compact('selectedItems'));
    }

    public function guestDeselectItem($id)
    {
        $user = auth()->user();
    
        if (!$user || !$user->selectedItems()->where('item_id', $id)->exists()) {
            return redirect()->route('guest.items.index')->with('warning', 'Tidak ada item yang bisa dihapus.');
        }
    
        $user->selectedItems()->detach($id);
    
        return redirect()->back()->with('success', 'Item berhasil dihapus dari pilihan.');
    }
    
    

    // =========================
    // User
    // =========================
    public function userIndex()
    {
        $items = Item::all(); // user bisa lihat semua
        $guests = User::where('role', 'guest')->with('selectedItems')->get();

        return view('user.items.index', compact('items', 'guests'));
    }

    public function userCreate()
    {
        return view('user.items.create');
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'item_code' => 'nullable|string|max:255',
            'inc' => 'nullable|string|max:255',
            'item_type' => 'nullable|string|max:255',
            'item_group' => 'nullable|string|max:255',
            'uom' => 'nullable|string|max:255',
            'denotation' => 'nullable|string|max:255',
            'keyword' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'old_code' => 'nullable|string|max:255',
            'cross_ref_1' => 'nullable|string|max:255',
            'cross_ref_2' => 'nullable|string|max:255',
            'cross_ref_3' => 'nullable|string|max:255',
            'functional_location' => 'nullable|string|max:255',
        ]);

        $item = Item::create([
            'item_code' => $request->item_code,
            'inc' => $request->inc,
            'item_type' => $request->item_type,
            'item_group' => $request->item_group,
            'uom' => $request->uom,
            'denotation' => $request->denotation,
            'keyword' => $request->keyword,
            'description' => $request->description,
            'old_code' => $request->old_code,
            'cross_ref_1' => $request->cross_ref_1,
            'cross_ref_2' => $request->cross_ref_2,
            'cross_ref_3' => $request->cross_ref_3,
            'functional_location' => $request->functional_location,
            'user_status' => 'draft', // default value
        ]);
        // Status diubah menjadi 0 (pengisian oleh User)
        $item->status = 0;

        $item->save();
        return redirect()->route('user.items.index')->with('success', 'Item berhasil ditambahkan.');
    }

    public function userEdit($id)
    {
        $item = Item::findOrFail($id);
        return view('user.items.edit', compact('item'));
    }

    public function userUpdate(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'item_code' => 'nullable|string|max:255',
            'inc' => 'nullable|string|max:255',
            'item_type' => 'nullable|string|max:255',
            'item_group' => 'nullable|string|max:255',
            'uom' => 'nullable|string|max:255',
            'denotation' => 'nullable|string|max:255',
            'keyword' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'old_code' => 'nullable|string|max:255',
            'cross_ref_1' => 'nullable|string|max:255',
            'cross_ref_2' => 'nullable|string|max:255',
            'cross_ref_3' => 'nullable|string|max:255',
            'functional_location' => 'nullable|string|max:255',
        ]);

        $item->update($request->only([
            'item_code',
            'inc',
            'item_type',
            'item_group',
            'uom',
            'denotation',
            'keyword',
            'description',
            'old_code',
            'cross_ref_1',
            'cross_ref_2',
            'cross_ref_3',
            'functional_location',
        ]));

        return redirect()->route('user.items.index')->with('success', 'Item berhasil diperbarui.');
    }

    public function userDestroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('user.items.index')->with('success', 'Item berhasil dihapus.');
    }

    public function userSubmit($id)
    {
        $item = Item::findOrFail($id);
    
        if ($item->status != 0) {
            return redirect()->route('user.items.index')->with('error', 'Item tidak dapat disubmit. Status item tidak sesuai.');
        }
    
        // Validasi bahwa semua field user harus terisi
        $requiredFields = [
            'item_code', 'inc', 'item_type', 'item_group', 'uom',
            'denotation', 'keyword', 'description', 'old_code',
            'cross_ref_1', 'cross_ref_2', 'cross_ref_3', 'functional_location'
        ];
    
        foreach ($requiredFields as $field) {
            if (empty($item->$field)) {
                return redirect()->route('user.items.index')->with('error', "Item tidak dapat disubmit. Field '$field' belum diisi.");
            }
        }
    
        $item->status = 1;
        $item->save();
    
        return redirect()->route('user.items.index')->with('success', 'Item berhasil disubmit dan menunggu persetujuan dari FAT.');
    }
    
    

    // =========================
    // FAT
    // =========================
    public function fatIndex()
    {
        // Ambil semua item yang statusnya 1 (menunggu input dari FAT)
        $items = Item::all();
    
        $guests = User::where('role', 'guest')->with('selectedItems')->get();

        return view('fat.items.index', compact('items', 'guests'));
    }
    

    
    

    public function fatEdit($id)
    {
        // Menampilkan form untuk mengedit COA dan GL
        $item = Item::findOrFail($id);
    
        // Pastikan item sudah disetujui oleh user (status 1)
        if ($item->status != 1) {
            return redirect()->route('fat.items.index')->with('error', 'Item tidak dapat diedit. Status item tidak sesuai.');
        }
        return view('fat.items.edit', compact('item'));
    }
    
    public function fatUpdate(Request $request, $id)
    {
        $item = Item::findOrFail($id);
    
        // Hanya bisa diupdate jika statusnya 1 (menunggu input dari FAT)
        if ($item->status != 1) {
            return redirect()->route('fat.items.index')->with('error', 'Item tidak dapat diupdate. Status item tidak sesuai.');
        }
    
        // Menambahkan data dari FAT (misalnya coa, gl)
        $item->coa = $request->input('coa');
        $item->gl = $request->input('gl');
        
        // Update status menjadi 2, menandakan item sudah diisi oleh FAT
        $item->save();
    
        return redirect()->route('fat.items.index')->with('success', 'Item berhasil diperbarui.');
    }
    
    public function fatSubmit($id)
    {
        $item = Item::findOrFail($id);
    
        if ($item->status != 1) {
            return redirect()->route('fat.items.index')->with('error', 'Item tidak dapat disubmit. Status item tidak sesuai.');
        }
    
        if (empty($item->coa) || empty($item->gl)) {
            return redirect()->route('fat.items.index')->with('error', 'Item tidak dapat disubmit. Harap lengkapi data COA dan GL.');
        }
    
        $item->status = 2;
        $item->save();
    
        return redirect()->route('fat.items.index')->with('success', 'Item berhasil disubmit dan menunggu persetujuan dari Procurement.');
    }
    

    // =========================
    // Procurement
    // =========================
    public function procIndex()
    {
        // Ambil semua item yang statusnya 2 (menunggu input dari Procurement)
        $items = Item::all();
    
        $guests = User::where('role', 'guest')->with('selectedItems')->get();

        return view('procurement.items.index', compact('items', 'guests'));
    }

    public function procEdit($id)
    {
        $item = Item::findOrFail($id);
    
        // Pastikan item sudah disetujui oleh FAT (status 2)
        if ($item->status != 2) {
            return redirect()->route('procurement.items.index')->with('error', 'Item tidak dapat diedit. Status item tidak sesuai.');
        }
    
        return view('procurement.items.edit', compact('item'));
    }
    

    public function procUpdate(Request $request, $id)
    {
        $item = Item::findOrFail($id);
    
        // Hanya bisa diupdate jika statusnya 2 (menunggu input dari Procurement)
        if ($item->status != 2) {
            return redirect()->route('procurement.items.index')->with('error', 'Item tidak dapat diupdate. Status item tidak sesuai.');
        }
    
        // Menambahkan data dari Procurement (misalnya unit_price, main_supplier)
        $item->unit_price = $request->input('unit_price');
        $item->main_supplier = $request->input('main_supplier');
        
        // Upd
        $item->save();
    
        return redirect()->route('procurement.items.index')->with('success', 'Item berhasil diupdate oleh Procurement.');
    }

    public function procSubmit($id)
    {
        $item = Item::findOrFail($id);
    
        if ($item->status != 2) {
            return redirect()->route('procurement.items.index')->with('error', 'Item tidak dapat disubmit. Status item tidak sesuai.');
        }
    
        if (empty($item->unit_price) || empty($item->main_supplier)) {
            return redirect()->route('procurement.items.index')->with('error', 'Item tidak dapat disubmit. Harap lengkapi harga dan supplier.');
        }
    
        $item->status = 3;
        $item->save();
    
        return redirect()->route('procurement.items.index')->with('success', 'Item berhasil disubmit dan menunggu persetujuan dari Logistik.');
    }
    

    // =========================
    // Logistik
    // =========================
    public function logistikIndex()
    {
        $items = Item::all();
        $guests = User::where('role', 'guest')->with('selectedItems')->get();

        return view('logistik.items.index', compact('items', 'guests'));
    }

    public function logistikEdit($id)
    {
        $item = Item::findOrFail($id);
    
        if ($item->status != 3) {
            return redirect()->route('logistik.items.index')->with('error', 'Item belum siap untuk diisi logistik.');
        }
    
        return view('logistik.items.edit', compact('item'));
    }
    

    public function logistikUpdate(Request $request, Item $item)
    {
        $request->validate([
            'storage_location' => 'nullable|string|max:255',
            'max_stock_level' => 'nullable|integer|min:0',
            'reorder_point' => 'nullable|integer|min:0',
        ]);

        $item->update([
            'storage_location' => $request->storage_location,
            'max_stock_level' => $request->max_stock_level,
            'reorder_point' => $request->reorder_point,
        ]);

        return redirect()->route('logistik.items.index')->with('success', 'Data logistik berhasil disimpan.');
    }

    public function logistikSubmit($id)
    {
        $item = Item::findOrFail($id);
    
        if ($item->status != 3) {
            return redirect()->route('logistik.items.index')->with('error', 'Item tidak dapat disubmit. Status item tidak sesuai.');
        }
    
        if (empty($item->storage_location) || is_null($item->max_stock_level) || is_null($item->reorder_point)) {
            return redirect()->route('logistik.items.index')->with('error', 'Item tidak dapat disubmit. Harap lengkapi semua data logistik.');
        }
    
        $item->status = 4;
        $item->save();
    
        return redirect()->route('logistik.items.index')->with('success', 'Item berhasil disubmit dan selesai diproses.');
    }
    

    // =========================
    // Hapus item (semua admin bisa)
    // =========================
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }
}
