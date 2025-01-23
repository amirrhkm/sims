<?php

namespace App\Http\Controllers;

use App\Models\BorrowingRequest;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function pengurusIndex()
    {
        $borrowingRequests = BorrowingRequest::with(['user'])
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($request) {
                $items = $request->getFormattedItemsAttribute();
                return [
                    'id' => $request->id,
                    'nama_item' => collect($items)->pluck('name')->join(', '),
                    'peminjam' => $request->user->name,
                    'tarikh_pinjam' => $request->start_time->format('Y-m-d'),
                    'tarikh_pulang' => $request->end_time->format('Y-m-d'),
                    'status' => $request->status,
                ];
            });

        return view('pengurus.laporan-main', compact('borrowingRequests'));
    }

    public function pemohonIndex()
    {
        $borrowingRequests = BorrowingRequest::with(['user'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($request) {
                $items = $request->getFormattedItemsAttribute();
                return [
                    'id' => $request->id,
                    'nama_item' => collect($items)->pluck('name')->join(', '),
                    'peminjam' => $request->user->name,
                    'tarikh_pinjam' => $request->start_time->format('Y-m-d'),
                    'tarikh_pulang' => $request->end_time->format('Y-m-d'),
                    'status' => $request->status,
                ];
            });

        return view('pemohon.laporan-main', compact('borrowingRequests'));
    }
}
