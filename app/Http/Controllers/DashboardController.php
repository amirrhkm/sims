<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\BorrowingRequest;
use App\Models\User;
use App\Models\Activity;

class DashboardController extends Controller
{
    public function pengurusIndex()
    {
        $totalItems = $this->getTotalItems();
        $itemsBorrowed = $this->getItemsBorrowed();
        $overdueItems = $this->getOverdueItems();
        $totalInventory = $this->getTotalInventory();
        $availableItems = $this->getAvailableItems();
        $activities = $this->getActivities();

        return view('pengurus.dashboard', compact(
            'totalItems',
            'itemsBorrowed',
            'overdueItems',
            'totalInventory',
            'availableItems',
            'activities'
        ));
    }

    public function pemohonIndex()
    {
        $totalItems = $this->getTotalItems();
        $itemsBorrowed = $this->getItemsBorrowed();
        $overdueItems = $this->getOverdueItems();
        $totalInventory = $this->getTotalInventory();
        $availableItems = $this->getAvailableItems();
        $activities = $this->getActivities();
        
        return view('pemohon.dashboard', compact(
            'totalItems',
            'itemsBorrowed',
            'overdueItems',
            'totalInventory',
            'availableItems',
            'activities'
        ));
    }

    private function getActivities()
    {
        $activities = Activity::whereHasMorph(
            'subject',
            [BorrowingRequest::class]
        )
        ->with(['causer', 'subject'])
        ->latest()
        ->take(10)
        ->get();

        return $activities;
    }

    private function getTotalItems()
    {
        $totalItems = Inventory::sum('quantity');
        return $totalItems;
    }

    private function getItemsBorrowed()
    {
        $itemsBorrowed = BorrowingRequest::where('status', 'approved')
            ->whereDate('end_time', '>=', now())
            ->get()
            ->sum(function($request) {
                $items = is_string($request->items) ? json_decode($request->items, true) : $request->items;
                return collect($items)->sum('quantity');
            });
        return $itemsBorrowed;
    }

    private function getOverdueItems()
    {
        $overdueItems = BorrowingRequest::where('status', 'approved')
            ->whereDate('end_time', '<', now())
            ->get()
            ->sum(function($request) {
                $items = is_string($request->items) ? json_decode($request->items, true) : $request->items;
                return collect($items)->sum('quantity');
            });
        return $overdueItems;
    }

    private function getActiveUsers()
    {
        $activeUsers = User::count();
        return $activeUsers;
    }

    private function getAvailableItems()
    {
        $availableItems = $this->getTotalItems() - ($this->getItemsBorrowed() + $this->getOverdueItems());
        return $availableItems;
    }

    private function getTotalInventory()
    {
        $totalInventory = $this->getTotalItems() + $this->getItemsBorrowed() + $this->getOverdueItems();
        return $totalInventory;
    }
}