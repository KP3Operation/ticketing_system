<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $tikets = Tiket::where('assignTo', Auth::id())->get();
        $status = Tiket::where('assignTo', Auth::id())
            ->whereNotIn('status', ['Closed', 'Reject'])
            ->get();
        $finished = Tiket::where('assignTo', Auth::id())
            ->where('status', 'Closed')
            ->get();

        // Hitung total tiket yang sudah closed di bulan ini
        $totalClosed = Tiket::where('assignTo', Auth::id())
            ->where('status', 'Closed')
            ->whereMonth('tglSelesai', now()->month)
            ->whereYear('tglSelesai', now()->year)
            ->count();

        return view('dashbord.index', compact('tikets', 'status', 'finished', 'totalClosed'));
    }
}
