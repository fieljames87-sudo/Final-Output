<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $logs = ActivityLog::with('user')->latest()->get();
        } else {
            $logs = ActivityLog::with('user')
                ->where('user_id', Auth::id())
                ->latest()
                ->get();
        }

        return view('activity-logs.index', compact('logs'));
    }
}