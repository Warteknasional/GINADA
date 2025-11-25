@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('scripts')
    {{-- Tambahkan script Chart.js hanya untuk halaman dashboard --}}
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
@endpush

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="row">
        {{-- Salin bagian Card Examples di sini (Earnings, Tasks, dll.) --}}
        
        <div class="col-xl-3 col-md-6 mb-4">
            {{-- Isi konten Card 1 --}}
        </div>
        
        {{-- ... dan seterusnya untuk semua card --}}
    </div>

    <div class="row">
        {{-- Salin Area Chart, Pie Chart, Project Card, dan Color System di sini --}}
        
        <div class="col-xl-8 col-lg-7">
            {{-- Isi konten Chart --}}
        </div>
        
        <div class="col-xl-4 col-lg-5">
            {{-- Isi konten Pie Chart --}}
        </div>
        
        {{-- ... dan seterusnya --}}
    </div>
@endsection