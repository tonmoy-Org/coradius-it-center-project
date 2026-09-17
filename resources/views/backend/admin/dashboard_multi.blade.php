@extends('backend.layouts.master')
@section('title', __('dashboard'))
@push('css')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <script src="{{ static_asset('admin/js/custom/dashboard/__chart.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
@section('content')
    <section class="oftions">
        @if(hasPermission('admin.dashboard'))
            <div class="container-fluid">
                
                <div class="row">
                    <!-- Total Leads -->
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="statistics-card bg-white color-success redious-border mb-20 p-20 p-md-20">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="statistics-info mb-3">
                                        <h6>Total Leads</h6>
                                        <h4>{{ $totalLeads }}</h4>
                                    </div>
                                </div>
                                <div class="statistics-footer d-flex align-items-center gap-3">
                                    <p class="sales-price text-success">All Time</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Today's Leads -->
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="statistics-card bg-white color-danger redious-border mb-20 p-20 p-sm-20">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="statistics-info mb-3">
                                        <h6>Today's Leads</h6>
                                        <h4>{{ $todayLeads }}</h4>
                                    </div>
                                </div>
                                <div class="statistics-footer d-flex align-items-center gap-3">
                                    <p class="sales-price text-danger">Today</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Yesterday's Leads -->
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="statistics-card bg-white color-blue redious-border mb-20 p-20 p-sm-20">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="statistics-info mb-3">
                                        <h6>Yesterday's Leads</h6>
                                        <h4>{{ $yesterdayLeads }}</h4>
                                    </div>
                                </div>
                                <div class="statistics-footer d-flex align-items-center gap-3">
                                    <p class="sales-price text-primary">Yesterday</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Leads -->
                    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">
                        <div class="statistics-card bg-white color-warning redious-border mb-20 p-20 p-sm-20">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="statistics-info mb-3">
                                        <h6>Monthly Leads</h6>
                                        <h4>{{ $monthlyLeads }}</h4>
                                    </div>
                                </div>
                                <div class="statistics-footer d-flex align-items-center gap-3">
                                    <p class="sales-price text-warning">This Month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="bg-white redious-border mb-4 pt-20 p-30">
                            <div class="section-top mb-2">
                                <h4>Recent</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered text-center align-middle">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Date Added</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($recentLeads as $lead)
                                    <tr>
                                        <td>{{ $lead->name }}</td>
                                        <td>{{ $lead->email }}</td>
                                        <td>{{ $lead->phone }}</td>
                                        <td>{{ $lead->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No recent leads found.</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="bg-white redious-border mb-4 pt-20 p-30">
                            <div class="section-top">
                                <h4>Leads Report (Last 7 Days)</h4>
                            </div>
                            <div class="statistics-report-chart">
                                <canvas id="leadsChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="bg-white redious-border mb-4 pt-20 p-30">
                            <div class="section-top">
                                <h4>Leads Report (Last 30 Days)</h4>
                            </div>
                            <div class="statistics-report-chart">
                                <canvas id="monthlyLeadsChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('leadsChart').getContext('2d');
        
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(63, 82, 227, 0.5)'); // Matches theme #3F52E3
        gradient.addColorStop(1, 'rgba(63, 82, 227, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $chartLabels !!},
                datasets: [{
                    label: 'New Leads',
                    data: {!! $chartData !!},
                    borderColor: '#3F52E3',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#3F52E3',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#334155',
                        bodyColor: '#334155',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' Leads';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5],
                            color: '#e2e8f0',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });

        // 30 Days Chart
        const ctxMonthly = document.getElementById('monthlyLeadsChart').getContext('2d');
        
        let gradientMonthly = ctxMonthly.createLinearGradient(0, 0, 0, 400);
        gradientMonthly.addColorStop(0, 'rgba(71, 195, 99, 0.5)'); // Matches theme #47C363
        gradientMonthly.addColorStop(1, 'rgba(71, 195, 99, 0.0)');

        new Chart(ctxMonthly, {
            type: 'line',
            data: {
                labels: {!! $monthlyChartLabels !!},
                datasets: [{
                    label: 'New Leads (Monthly)',
                    data: {!! $monthlyChartData !!},
                    borderColor: '#47C363',
                    backgroundColor: gradientMonthly,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#47C363',
                    pointBorderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#334155',
                        bodyColor: '#334155',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' Leads';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5],
                            color: '#e2e8f0',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b',
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#64748b'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });
    });
</script>
@endpush
