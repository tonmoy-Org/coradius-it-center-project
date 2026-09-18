@extends('backend.layouts.master')
@section('title', 'Marketing Leads')
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">Marketing Leads</h3>
                        <div class="oftions-content-right mb-12 d-flex gap-2">
                            <form action="{{ route('marketing-leads.index') }}" method="GET" class="d-flex gap-2 align-items-center" id="filterForm">
                                <select name="date_filter" class="form-control" id="date_filter" onchange="toggleCustomDate()">
                                    <option value="">All Time</option>
                                    <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Today</option>
                                    <option value="weekly" {{ request('date_filter') == 'weekly' ? 'selected' : '' }}>This Week</option>
                                    <option value="monthly" {{ request('date_filter') == 'monthly' ? 'selected' : '' }}>This Month</option>
                                    <option value="yearly" {{ request('date_filter') == 'yearly' ? 'selected' : '' }}>This Year</option>
                                    <option value="custom" {{ request('date_filter') == 'custom' ? 'selected' : '' }}>Custom Date</option>
                                </select>
                                
                                <div id="custom-date-container" class="d-flex gap-2 {{ request('date_filter') == 'custom' ? '' : 'd-none' }}">
                                    <input type="datetime-local" name="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="Start Date & Time">
                                    <input type="datetime-local" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="End Date & Time">
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                </div>
                            </form>
                            <a href="{{ route('marketing-leads.export', ['date_filter' => request('date_filter'), 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="d-flex align-items-center btn sg-btn-primary gap-2">
                                <i class="las la-file-export"></i>
                                <span>Export to CSV</span>
                            </a>
                        </div>
                    </div>

                    <!-- Webhook Settings Card -->
                    <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30 mb-4">
                        <h4 class="mb-3">Webhook Settings</h4>
                        <form action="{{ route('marketing-leads.webhook.save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="url" name="marketing_webhook_url" class="form-control" placeholder="https://hooks.zapier.com/..." value="{{ setting('marketing_webhook_url') }}" style="flex-grow: 1;">
                                            <button type="submit" class="btn sg-btn-primary" style="height: 44px; min-width: 150px;">Save Webhook</button>
                                        </div>
                                        <small class="text-muted mt-2 d-block">Enter your Zapier, Make, or custom CRM webhook URL. We will send a POST request with the lead's Name, Email, Phone, and Course ID instantly when they submit.</small>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="default-list-table table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Personal Info</th>
                                                <th>Phone</th>
                                                <th>WhatsApp</th>
                                                <th class="text-center">Synced</th>
                                                <th class="text-nowrap">Submitted At</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($leads as $key => $lead)
                                                <tr id="row_{{ $lead->id }}">
                                                    <td>{{ $leads->firstItem() + $key }}</td>
                                                    <td>
                                                        <div class="fw-semibold text-dark">{{ $lead->name }}</div>
                                                        @if($lead->email)
                                                            <small class="text-muted d-block">{{ $lead->email }}</small>
                                                        @endif
                                                    </td>
                                                    <td class="text-nowrap">{{ $lead->phone }}</td>
                                                    <td class="text-nowrap">{{ $lead->whatsapp_number ?: '-' }}</td>
                                                    <td class="text-center">
                                                        @if($lead->is_synced)
                                                            <span class="badge badge-success px-3 py-2">Yes</span>
                                                        @else
                                                            <span class="badge badge-danger px-3 py-2">No</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-nowrap">{{ $lead->created_at->format('d M Y, h:i A') }}</td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" onclick="delete_row('{{ route('marketing-leads.destroy', $lead->id) }}')"
                                                           data-toggle="tooltip" title="{{ __('delete') }}">
                                                            <i class="las la-trash-alt text-danger fs-5"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4">{{ __('no_data_found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @if ($leads->hasPages())
                                        <div class="pagination-wrapper mt-4">
                                            {{ $leads->links('vendor.pagination.bootstrap-4') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.delete-script')
    
    <script>
    function toggleCustomDate() {
        const filter = document.getElementById('date_filter').value;
        const container = document.getElementById('custom-date-container');
        if (filter === 'custom') {
            container.classList.remove('d-none');
        } else {
            container.classList.add('d-none');
            document.getElementById('filterForm').submit();
        }
    }
    </script>
@endsection
