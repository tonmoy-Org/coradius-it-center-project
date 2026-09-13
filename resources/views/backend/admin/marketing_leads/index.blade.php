@extends('backend.layouts.master')
@section('title', 'Marketing Leads')
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">Marketing Leads</h3>
                        <div class="oftions-content-right mb-12">
                            <a href="{{ route('marketing-leads.export') }}" class="d-flex align-items-center btn sg-btn-primary gap-2">
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
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Course / Source</th>
                                                <th>Synced to Webhook?</th>
                                                <th>Submitted At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($leads as $key => $lead)
                                                <tr id="row_{{ $lead->id }}">
                                                    <td>{{ $leads->firstItem() + $key }}</td>
                                                    <td>{{ $lead->name }}</td>
                                                    <td>{{ $lead->email }}</td>
                                                    <td>{{ $lead->phone }}</td>
                                                    <td>
                                                        @if($lead->course_id)
                                                            @php $course = \App\Models\Course::find($lead->course_id); @endphp
                                                            @if($course)
                                                                <a href="{{ route('course.details', $course->slug) }}" target="_blank">{{ $course->title }}</a>
                                                            @else
                                                                ID: {{ $lead->course_id }}
                                                            @endif
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($lead->is_synced)
                                                            <div class="badge badge-success">Yes</div>
                                                        @else
                                                            <div class="badge badge-danger">No</div>
                                                        @endif
                                                    </td>
                                                    <td>{{ $lead->created_at->format('d M Y, h:i A') }}</td>
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="delete_row('{{ route('marketing-leads.destroy', $lead->id) }}')"
                                                           data-toggle="tooltip" title="{{ __('delete') }}">
                                                            <i class="las la-trash-alt text-danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">{{ __('no_data_found') }}</td>
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
@endsection
