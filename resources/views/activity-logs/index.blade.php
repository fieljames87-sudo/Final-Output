@extends('layouts.app-dashboard')

@section('title', 'Activity Logs')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-4">Activity Logs</h2>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    @if(Auth::user()->role === 'admin')
                        <th class="border p-2">User</th>
                    @endif
                    <th class="border p-2">Action</th>
                    <th class="border p-2">Description</th>
                    <th class="border p-2">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        @if(Auth::user()->role === 'admin')
                            <td class="border p-2">{{ $log->user->name }}</td>
                        @endif
                        <td class="border p-2">{{ $log->action }}</td>
                        <td class="border p-2">{{ $log->description }}</td>
                        <td class="border p-2">{{ $log->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border p-2 text-center">No logs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection