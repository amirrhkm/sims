<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    // ---------------------------------- Controller for "Pemohon" ----------------------------------
    /*
    * [PEMOHON] lihat inventori.
    */
    public function index(Request $request)
    {
        $query = Inventory::query();

        // Handle search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        // Sort by category and then by name
        $inventories = $query->orderBy('category')
                            ->orderBy('name')
                            ->paginate(10)
                            ->withQueryString();

        return view('pemohon.inventori-lihat-inventori', compact('inventories'));
    }

    // ---------------------------------- Controller for "Pengurus" ----------------------------------
    /*
    * [PENGURUS] kemaskini inventori.
    */  
    public function kemaskini(Request $request)
    {
        $query = Inventory::query();

        // Handle search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%');
        }

        // Sort by category and then by name
        $inventories = $query->orderBy('category')
                            ->orderBy('name')
                            ->paginate(10)
                            ->withQueryString();

        return view('pengurus.inventori-kemaskini', compact('inventories'));
    }

    /*
    * [PENGURUS] tambah item baru ke inventori.
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'new_category' => 'required_if:category,new|string|max:255',
        ]);

        // Use new category if provided
        if ($request->category === 'new' && $request->filled('new_category')) {
            $validated['category'] = $request->new_category;
        }

        Inventory::create($validated);

        return redirect()
            ->route('pengurus.inventori-kemaskini')
            ->with('success', 'Item berjaya ditambah.');
    }

    /**
     * [PENGURUS] Hapus item inventori.
     */
    public function destroy($id)
    {
        try {
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();
            
            return redirect()
                ->route('pengurus.inventori-kemaskini')
                ->with('success', 'Item berjaya dipadamkan.');
        } catch (\Exception $e) {
            return redirect()
                ->route('pengurus.inventori-kemaskini')
                ->with('error', 'Gagal memadamkan item.');
        }
    }

    /**
     * [PENGURUS] Edit item inventori.
     */
    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $categories = Inventory::select('category')->distinct()->pluck('category');

        return view('pengurus.inventori-kemaskini-item-edit', compact('inventory', 'categories'));
    }

    /**
     * [PENGURUS] Kemaskini item inventori.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->update($validated);

        return redirect()->route('pengurus.inventori-kemaskini')->with('success', 'Item berjaya dikemaskini.');
    }

    /**
     * [PENGURUS] Show form for adding a new inventory item.
     */
    public function create()
    {
        $categories = Inventory::select('category')->distinct()->pluck('category');
        return view('pengurus.inventori-kemaskini-item-add', compact('categories'));
    }
}