@extends('backend.layouts.master')
@section('title', __('dashboard'))
@push('css')
    <!--====== Dropzone CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            
        </div>
    </section>
@endsection
