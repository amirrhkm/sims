<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\BorrowingRequest;

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

    /*
    * [PEMOHON] Show form for borrowing request.
    */
    public function showBorrowingRequestForm()
    {
        $inventories = Inventory::orderBy('category')
                                ->orderBy('name')
                                ->get();
        return view('pemohon.inventori-borang-permohonan', compact('inventories'));
    }

    /*
    * [PEMOHON] Simpan permohonan.
    */
    public function simpanPermohonan(Request $request)
    {
        $validated = $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'items' => 'required|array|min:1|max:8',
            'items.*.id' => 'required|exists:inventories,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
    
        $borrowingRequest = new BorrowingRequest();
        $borrowingRequest->user_id = auth()->id();
        $borrowingRequest->start_time = $validated['start_time'];
        $borrowingRequest->end_time = $validated['end_time'];
        $borrowingRequest->items = json_encode($validated['items']);
        $borrowingRequest->status = 'pending';
        $borrowingRequest->remarks = '';

        if (!$borrowingRequest->isValidDateRange()) {
            return back()->withErrors(['date' => 'Tarikh tamat mestilah selepas tarikh mula.']);
        }

        $borrowingRequest->save();
    
        return redirect()->route('pemohon.inventori')
                         ->with('success', 'Permohonan berjaya dihantar.');
    }

    /**
     * [PEMOHON] Display borrowing requests.
     */
    public function lihatPermohonan()
    {
        $borrowingRequests = BorrowingRequest::currentUser()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pemohon.inventori-lihat-permohonan', compact('borrowingRequests'));
    }

    /**
     * [PEMOHON] Delete borrowing request.
     */
    public function hapusPermohonan($id)
    {
        $request = BorrowingRequest::currentUser()->findOrFail($id);
        
        // Don't allow deletion of approved requests
        if ($request->status === 'approved') {
            return back()->with('error', 'Permohonan yang telah diluluskan tidak boleh dipadam.');
        }

        $request->delete();
        return back()->with('success', 'Permohonan berjaya dipadam.');
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

    public function reviewRequest()
    {
        $borrowingRequests = BorrowingRequest::with('user')->latest()->get();
        return view('pengurus.inventori-semak-permohonan', compact('borrowingRequests'));
    }

    public function showRequest($id)
    {
        $borrowingRequest = BorrowingRequest::findOrFail($id);
        return view('pengurus.inventori-semak-permohonan-show', compact('borrowingRequest'));
    }

    public function updateRequest(Request $request, $id)
    {
        $borrowingRequest = BorrowingRequest::findOrFail($id);
        $borrowingRequest->status = $request->action;

        // If request is approved, deduct quantities from inventory
        if ($request->action === 'approved') {
            $items = json_decode($borrowingRequest->items, true);
            
            foreach ($items as $item) {
                $inventory = Inventory::findOrFail($item['id']);
                
                // Check if there's enough quantity available
                if ($inventory->quantity < $item['quantity']) {
                    return redirect()->back()->with('error', 
                        "Kuantiti tidak mencukupi untuk item '{$inventory->name}'. Baki: {$inventory->quantity}");
                }
                
                // Deduct the quantity
                $inventory->quantity -= $item['quantity'];
                $inventory->save();
            }
        }

        if ($request->start_time) {
            $borrowingRequest->start_time = $request->start_time;
        }
        if ($request->end_time) {
            $borrowingRequest->end_time = $request->end_time;
        }
        if ($request->remarks) {
            $borrowingRequest->remarks = $request->remarks;
        }

        $borrowingRequest->save();
        
        return redirect()
            ->route('pengurus.inventori.permohonan.index')
            ->with('success', 'Permohonan berjaya dikemaskini.');
    }

    public function returnedRequest($id)
    {
        $borrowingRequest = BorrowingRequest::findOrFail($id);
        $borrowingRequest->status = 'returned';
        $borrowingRequest->save();

        return redirect()
            ->route('pengurus.inventori.permohonan.index')
            ->with('success', 'Permohonan berjaya dikembalikan.');
    }
}
