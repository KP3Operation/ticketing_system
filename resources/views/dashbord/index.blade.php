@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
@if (Auth::user()->statusUser == 1) 
<div class="row">
    <div class="col-xxl-8 mb-6 order-0">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-sm-7 d-flex align-items-center">
                    <div class="card-body text-start">
                        <h5 class="card-title text-primary mb-3">Selamat Datang, {{ Auth::user()->nama }}! 🎉</h5>
                        <h6>Kamu sudah menyelesaikan <span class="badge bg-info">{{ $totalClosed }}</span> tugas di bulan ini.</h6>
                    </div>
                </div>
                <div class="col-sm-5 d-flex align-items-center justify-content-center">
                    <img src="../../assets/img/illustrations/man-with-laptop-light.png" height="175"
                        alt="View Badge User">
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-lg-12">
        <div class="row">
            <!-- All Task Card -->
            <div class="col-xxl-6 col-lg-6 col-md-6 col-12 mb-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start mb-2">
                            <h6>All Task</h6>
                        </div>
                        <table class="table justify-content-between text-start task-table" >
                            <thead>
                                <tr>
                                    <th>ID Tiket</th>
                                    <th>Prioritas</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tikets as $tiket)
                                    <tr>
                                        <td><a
                                                href="{{ route('tiket.show', $tiket->idTiket) }}">{{ $tiket->idTiket }}</a>
                                        </td>
                                        <td>
                                            @if ($tiket->prioritas === 'Urgent')
                                                <span class="badge bg-label-danger me-1">{{ $tiket->prioritas }}</span>
                                            @elseif ($tiket->prioritas === 'High')
                                                <span class="badge bg-label-warning me-1">{{ $tiket->prioritas }}</span>
                                            @elseif ($tiket->prioritas === 'Normal')
                                                <span class="badge bg-label-success me-1">{{ $tiket->prioritas }}</span>
                                            @elseif ($tiket->prioritas === 'Low')
                                                <span class="badge bg-label-info me-1">{{ $tiket->prioritas }}</span>
                                            @else
                                                <span
                                                    class="badge bg-label-secondary me-1">{{ $tiket->prioritas }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $tiket->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Uncompleted Task Card -->
            <div class="col-xxl-6 col-lg-6 col-md-6 col-12 mb-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <h6>Uncompleted</h6>
                        </div>
                        <table class="table justify-content-between text-start task-table">
                            <thead>
                                <tr>
                                    <th>ID Tiket</th>
                                    <th>Prioritas</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($status as $item)
                                    <tr>
                                        <td><a
                                                href="{{ route('tiket.show', $item->idTiket) }}">{{ $item->idTiket }}</a>
                                        </td>
                                        <td>
                                            @if ($item->prioritas === 'Urgent')
                                                <span class="badge bg-label-danger me-1">{{ $item->prioritas }}</span>
                                            @elseif ($item->prioritas === 'High')
                                                <span class="badge bg-label-warning me-1">{{ $item->prioritas }}</span>
                                            @elseif ($item->prioritas === 'Normal')
                                                <span class="badge bg-label-success me-1">{{ $item->prioritas }}</span>
                                            @elseif ($item->prioritas === 'Low')
                                                <span class="badge bg-label-info me-1">{{ $item->prioritas }}</span>
                                            @else
                                                <span
                                                    class="badge bg-label-secondary me-1">{{ $item->prioritas }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xxl-6 col-lg-6 col-md-6 col-12 mb-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <h6>Complete</h6>
                        </div>
                        <table class="table justify-content-between text-start task-table">
                            <thead>
                                <tr>
                                    <th>ID Tiket</th>
                                    <th>Prioritas</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($finished as $item)
                                    <tr>
                                        <td><a
                                                href="{{ route('tiket.show', $item->idTiket) }}">{{ $item->idTiket }}</a>
                                        </td>
                                        <td>
                                            @if ($item->prioritas === 'Urgent')
                                                <span class="badge bg-label-danger me-1">{{ $item->prioritas }}</span>
                                            @elseif ($item->prioritas === 'High')
                                                <span class="badge bg-label-warning me-1">{{ $item->prioritas }}</span>
                                            @elseif ($item->prioritas === 'Normal')
                                                <span class="badge bg-label-success me-1">{{ $item->prioritas }}</span>
                                            @elseif ($item->prioritas === 'Low')
                                                <span class="badge bg-label-info me-1">{{ $item->prioritas }}</span>
                                            @else
                                                <span
                                                    class="badge bg-label-secondary me-1">{{ $item->prioritas }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.3/b-3.1.1/b-colvis-3.1.1/b-html5-3.1.1/b-print-3.1.1/sl-2.0.4/datatables.min.js">
    </script>
    <script>
        var table = $('.task-table').DataTable({
            layout: {
                topEnd: [
                    'search',
                ],
            },
        })
    </script>
@endpush
