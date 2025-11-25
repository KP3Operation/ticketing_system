<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
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
            ->where('status', ['Closed'])
            ->get();
        $totalClosed = Tiket::where('assignTo', Auth::id())
            ->where('status', 'Closed')
            ->count();

        return view('dashbord.index', compact('tikets', 'status', 'finished', 'totalClosed'));
    }
}
