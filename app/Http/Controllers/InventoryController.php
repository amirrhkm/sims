<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
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
}